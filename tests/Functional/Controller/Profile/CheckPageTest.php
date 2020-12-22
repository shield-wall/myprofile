<?php

namespace App\Tests\Functional\Controller\Profile;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Generator;

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
        /** @var UserRepository $userRepository */
        $userRepository = self::$container->get(UserRepository::class);
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

        $absoluteUrlToLogin = 'http://localhost/%s/login';
        $this->assertTrue(
            $response->isRedirect(sprintf($absoluteUrlToLogin, 'pt_BR'))
            || $response->isRedirect(sprintf($absoluteUrlToLogin, 'en')));
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
}