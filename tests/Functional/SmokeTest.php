<?php
declare(strict_types=1);

use Symfony\Component\HttpFoundation\Request;

it('checks if the page is loading', function (string $url, string $tag) {
    $client = $this->createClient();
    $crawler = $client->request(Request::METHOD_GET, $url);
    $this->assertResponseIsSuccessful();

    expect($crawler->filter($tag)->count())->toBeTruthy();
})->with([
    ['/', '#home-button-register'],
    ['/en', '#home-button-register'],

    ['/test-mock', '#home-title'],
    ['/test-mock/en', '#home-title'],

    ['/test-mock/curriculum/pt_BR', '#name'],
    ['/test-mock/curriculum/en', '#name'],

    ['/login', '#page-title'],
    ['/login/en', '#page-title'],

    ['/register', '#page-title'],
    ['/register/en', '#page-title'],

    ['/reset-password', '#page-title'],
    ['/reset-password/en', '#page-title'],
]);
