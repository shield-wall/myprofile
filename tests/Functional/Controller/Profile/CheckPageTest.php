<?php

namespace App\Tests\Functional\Controller\Profile;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

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
     * @param string $field
     * @param string $value
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

    public function providerCheckPage()
    {
        return [
            #main
            ['/profile/pt_BR/edit', 'app_user_profile[first_name]', 'Test'],
            ['/profile/en/edit', 'app_user_profile[last_name]', 'Mock'],
            #user's network
            ['/profile/pt_BR/usersocialnetworking'],
            ['/profile/en/usersocialnetworking'],
            ['/profile/pt_BR/usersocialnetworking/new', 'App_usersocialnetworking[link]'],
            ['/profile/en/usersocialnetworking/new', 'App_usersocialnetworking[socialNetworking]'],
            #education
            ['/profile/pt_BR/education'],
            ['/profile/en/education'],
            ['/profile/pt_BR/education/new', 'App_education[title]'],
            ['/profile/en/education/new', 'App_education[institution]'],
            #experience
            ['/profile/pt_BR/experience'],
            ['/profile/en/experience'],
            ['/profile/pt_BR/experience/new', 'App_experience[title]'],
            ['/profile/en/experience/new', 'App_experience[company]'],
            #certification
            ['/profile/pt_BR/certification'],
            ['/profile/en/certification'],
            ['/profile/pt_BR/certification/new', 'App_certification[title]'],
            ['/profile/en/certification/new', 'App_certification[institution]'],
            #user`s language
            ['/profile/pt_BR/user-language'],
            ['/profile/en/user-language'],
            ['/profile/pt_BR/user-language/new', 'user_language[name]'],
            ['/profile/en/user-language/new', 'user_language[level]', 'BEGINNER'],
            #skill
            ['/profile/pt_BR/skill'],
            ['/profile/en/skill'],
            ['/profile/pt_BR/skill/new', 'App_skill[name]'],
            ['/profile/en/skill/new', 'App_skill[priority]'],
            #change password
            ['/profile/pt_BR/change-password', 'change_password_account_form[plainPassword][first]'],
            ['/profile/en/change-password', 'change_password_account_form[plainPassword][second]'],
        ];
    }
}