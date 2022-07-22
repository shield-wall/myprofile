<?php

declare(strict_types=1);

use App\Repository\UserRepository;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;
use Symfony\Component\HttpFoundation\Request;
use function Pest\Faker\faker;

beforeAll(function () {
    uses(ReloadDatabaseTrait::class);
});

beforeEach(function () {
    $client = $this->createClient();

    $container = $client->getContainer();
    $userRepository = $container->get(UserRepository::class);
    $user = $userRepository->findOneBy(['email' => 'test@myprofile.pro']);
    $client->loginUser($user);

    $this->client = $client;
});

dataset('page_list', [
    'skill' => [
        '/profile/en/skill', [
            'skill[name]' => faker()->colorName(),
            'skill[levelExperience]' => faker()->numberBetween(0, 100),
            'skill[priority]' => faker()->randomDigit(),
        ]
    ],
]);

it('can see the page list', function (string $listUrl) {
    $crawler = $this->client->request(Request::METHOD_GET, $listUrl);

    expect($crawler)->hasHtmlTag('#add-button');

    $crawler = $this->client->clickLink('New');

    expect($crawler)
        ->hasHtmlTag('form')
        ->and($crawler)
        ->hasHtmlTag('#submit-button');
})->with('page_list');

it('is creating a new register', function (string $listUrl, array $formFields) {
    $this->client->request(Request::METHOD_GET, sprintf('%s/new', $listUrl));

    $this->client->submitForm('New', $formFields);

    $this->assertResponseRedirects($listUrl);
})->with('page_list');