<?php

declare(strict_types=1);

use Symfony\Component\HttpFoundation\Request;

it('is checking the home page', function (string $url, string $registerTitle, string $loginTitle)
{
        $client = $this->createClient();

        $crawler = $client->request(Request::METHOD_GET, $url);
        $this->assertResponseIsSuccessful();
        $this->assertGreaterThan(0, $crawler->filter('#example-of-users .column')->count());

        $loginLink = $crawler->filter('#home-button-login')->link();
        $registerLink = $crawler->filter('#home-button-register')->link();

        $client->click($registerLink);
        $this->assertSelectorTextContains('title', $registerTitle);

        $client->click($loginLink);
        $this->assertSelectorTextContains('title', $loginTitle);
})->with([
    ['/', 'Registrar | My profile', 'Entrar | My profile'],
    ['/en', 'Sign up | My profile', 'Welcome | My profile'],
]);