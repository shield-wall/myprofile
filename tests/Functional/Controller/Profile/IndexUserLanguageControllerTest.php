<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller\Profile;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

it('is checking the user-language list page', function ($userEmail, $quantityOfLanguages)
{
    $client = $this->createClient();

    /** @var UserRepository $userRepository */
    $userRepository = $this->getContainer()->get(UserRepository::class);
    $user = $userRepository->findOneBy(['email' => $userEmail]);

    $client->loginUser($user);
    $crawler = $client->request(Request::METHOD_GET, '/profile/pt_BR/user-language#language');
    $this->assertResponseIsSuccessful();

    expect($crawler->filter('tbody tr')->count())->toBe($quantityOfLanguages);
})->with([
    ['test@myprofile.pro', 1],
    ['test2@myprofile.pro', 3],
]);