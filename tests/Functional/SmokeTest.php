<?php

declare(strict_types=1);

use Symfony\Component\HttpFoundation\Request;

it('checks if the page is loading', function (string $url, string $tag = null) {
    $client = $this->createClient();
    $crawler = $client->request(Request::METHOD_GET, $url);
    $this->assertResponseIsSuccessful();

    if($tag) {
        expect($crawler->filter($tag)->count())->toBeTruthy();
    }
})->with([
    'Homepage (Portuguese)' => ['/', '#logo'],
    'Homepage (English)' =>['/en', '#logo'],

    'Public user profile (Portuguese)' => ['/test-mock', '#home-title'],
    'Public user profile (English)' => ['/test-mock/en', '#home-title'],

    'Curriculum (Portuguese)' => ['/test-mock/curriculum/pt_BR', '#name'],
    'Curriculum (English)' => ['/test-mock/curriculum/en', '#name'],

    'Privacy policy (Portuguese)' => ['/pt_BR/privacy-policy', '#privacy-policy-title'],
    'Privacy policy (English)' => ['/en/privacy-policy', '#privacy-policy-title'],

    'Login (Portuguese)' => ['/login/pt_BR', '#logo'],
    'Login (English)' => ['/login/en', '#logo'],

    'Main sitemap' => ['/sitemap.xml'],
    'Static sitemap (English)' => ['/sitemap.static_en.xml'],
    'Static sitemap (Portuguese)' => ['/sitemap.static_pt_BR.xml'],
    'Profile sitemap (English)' => ['/sitemap.profile_en.xml'],
    'Profile sitemap (Portuguese)' => ['/sitemap.profile_pt_BR.xml'],
]);

it('is redirecting', function (string $url, string $redirectTo) {
    $client = $this->createClient();
    $client->request(Request::METHOD_GET, $url);
    $this->assertResponseRedirects($redirectTo);

    //Avoid multi redirect.
    $client->request(Request::METHOD_GET, $redirectTo);
    expect($client->getResponse()->isRedirect())->toBeFalse();
})->with([
    'Logout (Portuguese)' => ['/logout/pt_BR', 'http://localhost/login/pt_BR'],
    'Logout (English)' => ['/logout/en', 'http://localhost/login/en'],
]);
