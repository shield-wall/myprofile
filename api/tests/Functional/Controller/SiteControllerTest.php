<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class SiteControllerTest extends WebTestCase
{
    /**
     * @dataProvider homePageProvideData
     *
     * @param string $url
     * @param string $registerTitle
     * @param string $loginTitle
     */
    public function testCanSeeHomePage(string $url, string $registerTitle, string $loginTitle)
    {
        $client = static::createClient();

        $crawler = $client->request(Request::METHOD_GET, $url);
        $this->assertResponseIsSuccessful();
        $this->assertGreaterThan(0, $crawler->filter('#example-of-users .column')->count());

        $loginLink = $crawler->filter('#home-button-login')->link();
        $registerLink = $crawler->filter('#home-button-register')->link();

        $client->click($registerLink);
        $this->assertSelectorTextContains('title', $registerTitle);

        $client->click($loginLink);
        $this->assertSelectorTextContains('title', $loginTitle);
    }

    public function homePageProvideData()
    {
        return [
            ['/', 'Registrar | My profile', 'Entrar | My profile'],
            ['/en', 'Sign up | My profile', 'Welcome | My profile'],
        ];
    }
}