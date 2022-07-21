<?php

namespace App\Controller;

use League\OAuth2\Client\Provider\AbstractProvider;
use LogicException;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route(name: 'app_', defaults: ['_locale' => 'pt_BR'], priority: 10)]
class SecurityController extends AbstractController
{
    public function __construct(private readonly LoggerInterface $logger)
    {
    }

    #[Route(path: '/login/{_locale}', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if (null !== $this->getUser()) {
            return $this->redirectToRoute('profile_edit');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout/{_locale}', name: 'logout')]
    public function logout(): never
    {
        throw new LogicException('it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/auth-third-party', name: 'auth_third_party')]
    #[Route(path: '/auth-third-party/callback', name: 'auth_third_party__callback')]
    public function authThirdParty(Request $request, AbstractProvider $googleAuthProvider): ?Response
    {
        /**
         * it's a fake endpoint who will handle this is the ThirdPartyAuthenticator.
         */
        if ('app_auth_third_party__callback' === $request->attributes->get('_route')) {
            return null;
        }

        if (null !== $this->getUser()) {
            return $this->redirectToRoute('profile_edit');
        }

        $submittedToken = $request->get('token');

        if (!$this->isCsrfTokenValid('third-party-login', $submittedToken)) {
            $this->logger->error('Invalid CSRF third party authentication');

            throw new InvalidCsrfTokenException();
        }

        return $this->redirect($googleAuthProvider->getAuthorizationUrl());
    }
}
