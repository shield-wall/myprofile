<?php

declare(strict_types=1);

use Symfony\Component\HttpFoundation\Request;

it('checks if the page is loading', function (string $url, string $tag) {
    $client = $this->createClient();
    $crawler = $client->request(Request::METHOD_GET, $url);
    $this->assertResponseIsSuccessful();

    expect($crawler->filter($tag)->count())->toBeTruthy();
})->with([
    ['/', '#logo'],
    ['/en', '#logo'],

    ['/test-mock', '#home-title'],
    ['/test-mock/en', '#home-title'],

    ['/test-mock/curriculum/pt_BR', '#name'],
    ['/test-mock/curriculum/en', '#name'],

    ['/login/pt_BR', '#logo'],
    ['/login/en', '#logo'],
]);
