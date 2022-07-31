<?php

declare(strict_types=1);

use Symfony\Component\HttpFoundation\Request;

it('checks if the page is loading', function (string $url, string $tag) {
    $client = $this->createClient();
    $crawler = $client->request(Request::METHOD_GET, $url);
    $this->assertResponseIsSuccessful();

    expect($crawler->filter($tag)->count())->toBeTruthy();
})->with([
    'Homepage (Portuguese)' => ['/', '#logo'],
    'Homepage (English)' =>['/en', '#logo'],

    'Public user profile (Portuguese)' => ['/test-mock', '#home-title'],
    'Public user profile (English)' => ['/test-mock/en', '#home-title'],

    'Curriculum (Portuguese)' => ['/test-mock/curriculum/pt_BR', '#name'],
    'Curriculum (English)' => ['/test-mock/curriculum/en', '#name'],

    'Login (Portuguese)' => ['/login/pt_BR', '#logo'],
    'Login (English)' => ['/login/en', '#logo'],

    'Privacy policy (Portuguese)' => ['/pt_BR/privacy-policy', '#privacy-policy-title'],
    'Privacy policy (English)' => ['/en/privacy-policy', '#privacy-policy-title'],
]);
