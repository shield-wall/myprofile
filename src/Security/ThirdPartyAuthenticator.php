<?php

namespace App\Security;

use App\Entity\User;
use App\Repository\UserRepository;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\GoogleUser;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class ThirdPartyAuthenticator extends AbstractAuthenticator
{
    private const THIRD_PARTY_ROUTE = 'app_auth_third_party__callback';

    private readonly AbstractProvider $provider;

    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UrlGeneratorInterface $urlGenerator,
        private readonly LoggerInterface $logger,
        private readonly UserPasswordHasherInterface $passwordHasher,
        AbstractProvider $googleAuthProvider,
    ) {
        $this->provider = $googleAuthProvider;
    }

    public function supports(Request $request): ?bool
    {
        return self::THIRD_PARTY_ROUTE === $request->attributes->get('_route');
    }

    public function authenticate(Request $request): Passport
    {
        if ($request->get('error') || !$request->get('code')) {
            return new SelfValidatingPassport(
                new UserBadge('', static fn () => throw new UserNotFoundException())
            );
        }

        $apiCode = $request->get('code');

        $apiToken = $this->provider->getAccessToken('authorization_code', ['code' => $apiCode]);

        /** @var GoogleUser $ownerDetails */
        $ownerDetails = $this->provider->getResourceOwner($apiToken); //@phpstan-ignore-line

        return new SelfValidatingPassport(
            new UserBadge($ownerDetails->getEmail(), function ($email) use ($ownerDetails) {
                // TODO Refactor this method.
                $user = $this->userRepository->findOneBy(['email' => $email]);

                if (!$user instanceof User) {
                    $user = new User();
                    $user
                        ->setFirstName($ownerDetails->getFirstName())
                        ->setLastName($ownerDetails->getLastName())
                        ->setEmail($ownerDetails->getEmail())
                        ->setIsVerified(true)
                    ;

                    $user->setPassword(
                        $this->passwordHasher->hashPassword($user, bin2hex(random_bytes(50)))
                    );

                    $this->userRepository->create($user);
                }

                return $user;
            })
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return new RedirectResponse($this->urlGenerator->generate('profile_edit'));
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $this->logger->error('Third party authentication,', ['message' => $exception->getMessage()]);

        $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);

        return new RedirectResponse($this->urlGenerator->generate('app_login'));
    }
}
