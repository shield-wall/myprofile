<?php

namespace App\Tests\Functional\Controller\Profile;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Generator;
use Symfony\Component\HttpFoundation\Response;

class CheckPageTest extends WebTestCase
{

    protected $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    /**
     * @dataProvider providerCheckPage
     *
     * @param string $url
     * @param string|null $field
     * @param string|null $value
     */
    public function testCanCheckPage(string $url, string $field = null, string $value = null)
    {
        $container = $this->client->getContainer();

        /** @var UserRepository $userRepository */
        $userRepository = $container->get(UserRepository::class);
        $user = $userRepository->findOneBy(['email' => 'test@myprofile.pro']);

        $this->client->loginUser($user);

        $crawler = $this->client->request(Request::METHOD_GET, $url);

        $this->assertResponseIsSuccessful();

        if ($field) {
            $this->assertEquals($value, $crawler->filter('form')->form()->get($field)->getValue());
        }
    }

    /**
     * @dataProvider providerCheckPage
     *
     * @param string $url
     */
    public function testCanNotAccessPage(string $url)
    {
        $this->client->request(Request::METHOD_GET, $url);
        $response = $this->client->getResponse();

        $absoluteUrlToLogin = 'http://localhost/login%s';
        $this->assertTrue(
            $response->isRedirect(sprintf($absoluteUrlToLogin, ''))
            || $response->isRedirect(sprintf($absoluteUrlToLogin, '/en')));
    }

    /**
     * @dataProvider providerOwnerPage
     * @param string $indexUrl
     */
    public function testCannotAccessDataFromOtherUser(string $indexUrl)
    {
        $container = $this->client->getContainer();
        $userRepository = $container->get(UserRepository::class);
        $user1 = $userRepository->findOneBy(['email' => 'test@myprofile.pro']);
        $user2 = $userRepository->findOneBy(['email' => 'test2@myprofile.pro']);

        $this->client->loginUser($user1);
        $crawler = $this->client->request(Request::METHOD_GET, $indexUrl);
        $this->assertResponseIsSuccessful();

        $link = $crawler->filter('.edit')->link();

        $this->client->click($link);
        $this->assertResponseIsSuccessful();

        $this->client->loginUser($user2);
        $this->client->click($link);
        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);

    }

    public function providerCheckPage(): Generator
    {
        #main
        yield ['/profile/pt_BR/edit', 'app_user_profile[first_name]', 'Test'];
        yield ['/profile/en/edit', 'app_user_profile[last_name]', 'Mock'];
        #user's network
        yield ['/profile/pt_BR/usersocialnetworking'];
        yield ['/profile/en/usersocialnetworking'];
        yield ['/profile/pt_BR/usersocialnetworking/new', 'App_usersocialnetworking[link]'];
        yield ['/profile/en/usersocialnetworking/new', 'App_usersocialnetworking[socialNetworking]'];
        #education
        yield ['/profile/pt_BR/education'];
        yield ['/profile/en/education'];
        yield ['/profile/pt_BR/education/new', 'App_education[title]'];
        yield ['/profile/en/education/new', 'App_education[institution]'];
        #experience
        yield ['/profile/pt_BR/experience'];
        yield ['/profile/en/experience'];
        yield ['/profile/pt_BR/experience/new', 'App_experience[title]'];
        yield ['/profile/en/experience/new', 'App_experience[company]'];
        #certification
        yield ['/profile/pt_BR/certification'];
        yield ['/profile/en/certification'];
        yield ['/profile/pt_BR/certification/new', 'App_certification[title]'];
        yield ['/profile/en/certification/new', 'App_certification[institution]'];
        #user`s language
        yield ['/profile/pt_BR/user-language'];
        yield ['/profile/en/user-language'];
        yield ['/profile/pt_BR/user-language/new', 'user_language[name]'];
        yield ['/profile/en/user-language/new', 'user_language[level]', 'BEGINNER'];
        #skill
        yield ['/profile/pt_BR/skill'];
        yield ['/profile/en/skill'];
        yield ['/profile/pt_BR/skill/new', 'App_skill[name]'];
        yield ['/profile/en/skill/new', 'App_skill[priority]'];
        #change password
        yield ['/profile/pt_BR/change-password', 'change_password_account_form[plainPassword][first]'];
        yield ['/profile/en/change-password', 'change_password_account_form[plainPassword][second]'];
    }

    public function providerOwnerPage(): Generator
    {
        yield ['/profile/en/certification'];
        yield ['/profile/en/education'];
        yield ['/profile/en/user-language'];
    }
}