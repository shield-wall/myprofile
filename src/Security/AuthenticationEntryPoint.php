<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

class AuthenticationEntryPoint implements AuthenticationEntryPointInterface
{
    public function __construct(private readonly UrlGeneratorInterface $urlGenerator)
    {
    }

    public function start(Request $request, AuthenticationException $authException = null): RedirectResponse
    {
        /** @phpstan-ignore-next-line */
        $request
            ->getSession()
            ->getFlashBag()
            ->add('warning', 'You have to login in order to access this page.');

        return new RedirectResponse($this->urlGenerator->generate('app_login'));
    }
}
