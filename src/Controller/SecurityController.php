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

#[Route(name: 'app_', defaults: ['_locale' => 'pt_BR'], priority: 10)]
class SecurityController extends AbstractController
{
    #[Route(path: '/logout/{_locale}', name: 'logout')]
    public function logout(): never
    {
        throw new LogicException('it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/auth-third-party', name: 'auth_third_party')]
    public function authThirdParty(
        Request $request,
        AbstractProvider $googleAuthProvider,
        LoggerInterface $logger
    ): ?Response {
        if (null !== $this->getUser()) {
            return $this->redirectToRoute('profile_edit');
        }

        /** @var ?string $submittedToken */
        $submittedToken = $request->get('token');

        if (!$this->isCsrfTokenValid('third-party-login', $submittedToken)) {
            $logger->error('Invalid CSRF third party authentication');

            throw new InvalidCsrfTokenException();
        }

        return $this->redirect($googleAuthProvider->getAuthorizationUrl());
    }
}
