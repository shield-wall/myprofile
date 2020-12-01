<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
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
     * @param string $selectorTag
     * @param string $selectorValue
     */
    public function testCanCheckPage(string $url, string $selectorTag, string $selectorValue)
    {
        $this->client->request(Request::METHOD_GET, $url);
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains($selectorTag, $selectorValue);
    }

    /**
     * todo change this to behat
     */
    public function providerCheckPage()
    {
        return [
            #homepage
            ['/', '#home-button-register', 'Criar meu currículo 2020'],
            ['/en', '#home-button-register', 'Make my curriculum vitae 2020'],

            #user profile
            ['/test-mock', '#home-title', 'Test Mock'],
            ['/test-mock/en', '#home-title', 'Test Mock'],

            #create curriculum
            ['/test-mock/curriculum/pt_BR', '#name', 'Test Mock'],
            ['/test-mock/curriculum/en', '#name', 'Test Mock'],

            #login
            ['/pt_BR/login', '#page-title', 'Bem-vindo novamente!'],
            ['/en/login', '#page-title', 'Welcome back!'],

            #register
            ['/pt_BR/register', '#page-title', 'Registre-se'],
            ['/en/register', '#page-title', 'Hello, Friend!'],

            #reset-password
            ['/pt_BR/reset-password', '#page-title', 'Redefinir minha senha'],
            ['/en/reset-password', '#page-title', 'Reset your password'],
        ];
    }
}