<?php

namespace App\Tests\Functional\Controller\Profile;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

it('is checking if the page is loaded', function (string $url, string $field = null, string $value = null) {
    $client = $this->createClient();
    $container = $this->getContainer();

    /** @var UserRepository $userRepository */
    $userRepository = $container->get(UserRepository::class);
    $user = $userRepository->findOneBy(['email' => 'test@myprofile.pro']);

    $client->loginUser($user);

    $crawler = $client->request(Request::METHOD_GET, $url);

    $this->assertResponseIsSuccessful();

    if ($field) {
        $this->assertEquals($value, $crawler->filter('form')->form()->get($field)->getValue());
    }
})->with(function () {
        #main
        yield ['/profile/pt_BR/edit', 'profile[first_name]', 'Test'];
        yield ['/profile/en/edit', 'profile[last_name]', 'Mock'];
        #user's network
        yield ['/profile/pt_BR/usersocialnetworking'];
        yield ['/profile/en/usersocialnetworking'];
        yield ['/profile/pt_BR/usersocialnetworking/new', 'user_social_networking[link]'];
        yield ['/profile/en/usersocialnetworking/new', 'user_social_networking[socialNetworking]'];
        #education
        yield ['/profile/pt_BR/education'];
        yield ['/profile/en/education'];
        yield ['/profile/pt_BR/education/new', 'education[title]'];
        yield ['/profile/en/education/new', 'education[institution]'];
        #experience
        yield ['/profile/pt_BR/experience'];
        yield ['/profile/en/experience'];
        yield ['/profile/pt_BR/experience/new', 'experience[title]'];
        yield ['/profile/en/experience/new', 'experience[company]'];
        #certification
        yield ['/profile/pt_BR/certification'];
        yield ['/profile/en/certification'];
        yield ['/profile/pt_BR/certification/new', 'certification[title]'];
        yield ['/profile/en/certification/new', 'certification[institution]'];
        #user`s language
        yield ['/profile/pt_BR/user-language'];
        yield ['/profile/en/user-language'];
        yield ['/profile/pt_BR/user-language/new', 'user_language[name]'];
        yield ['/profile/en/user-language/new', 'user_language[level]', 'BEGINNER'];
        #skill
        yield ['/profile/pt_BR/skill'];
        yield ['/profile/en/skill'];
        yield ['/profile/pt_BR/skill/new', 'skill[name]'];
        yield ['/profile/en/skill/new', 'skill[priority]'];
        #change password
        yield ['/profile/pt_BR/change-password', 'change_password_account_form[plainPassword][first]'];
        yield ['/profile/en/change-password', 'change_password_account_form[plainPassword][second]'];
});

dataset('page_list', [
     ['/profile/en/certification'],
     ['/profile/en/education'],
     ['/profile/en/user-language'],
]);

it('is redirecting to login page when the user is not log in', function(string $url) {
    $client = $this->createClient();

    $client->request(Request::METHOD_GET, $url);
    $response = $client->getResponse();

    $absoluteUrlToLogin = '/login%s';
    $this->assertTrue(
        $response->isRedirect(sprintf($absoluteUrlToLogin, ''))
        || $response->isRedirect(sprintf($absoluteUrlToLogin, '/en')));

})->with('page_list');

it('is checking that the user can not access data/page from other user', function(string $indexUrl) {
    $client = $this->createClient();
    $container = $this->getContainer();

    $userRepository = $container->get(UserRepository::class);
    $user1 = $userRepository->findOneBy(['email' => 'test@myprofile.pro']);
    $user2 = $userRepository->findOneBy(['email' => 'test2@myprofile.pro']);

    $client->loginUser($user1);
    $crawler = $client->request(Request::METHOD_GET, $indexUrl);
    $this->assertResponseIsSuccessful();

    $link = $crawler->filter('.edit')->link();

    $client->click($link);
    $this->assertResponseIsSuccessful();

    $client->loginUser($user2);
    $client->click($link);
    $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);

})->with('page_list');