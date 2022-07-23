<?php

declare(strict_types=1);

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

beforeEach(function () {
    $client = $this->createClient();

    $container = $client->getContainer();
    $userRepository = $container->get(UserRepository::class);
    $user = $userRepository->findOneBy(['email' => 'test-profile@myprofile.pro']);
    $client->loginUser($user);

    $this->client = $client;
});

it('is creating a new register', function (string $listUrl, array $formFields) {
    $crawler = $this->client->request(Request::METHOD_GET, $listUrl);
    $rows = $crawler->filter('#table-list tbody tr')->count();

    //it's going to create page.
    $this->client->clickLink('New');
    $this->client->submitForm('New', $formFields);

    $this->assertResponseRedirects($listUrl);

//    Checking if there is one more register.
    $crawler = $this->client->request(Request::METHOD_GET, $listUrl);
    expect($crawler->filter('#table-list tbody tr')->count())->toBe($rows+1);

})->with('page_list');

it('is updating an item', function (string $listUrl, array $formFields) {
    //Page list
    $crawler = $this->client->request(Request::METHOD_GET, $listUrl);

    //going to edit page
    $firstEditButtonLink = $crawler
        ->filter('#table-list tbody tr')
        ->filter('.table-list-actions .edit-button')
        ->link();
    $this->client->click($firstEditButtonLink);

    $this->client->submitForm('Save', $formFields);

    $this->assertResponseRedirects($listUrl);
})->with('page_list');