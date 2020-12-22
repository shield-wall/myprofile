<?php

namespace App\Tests\Functional;

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
     * @param string $selectorTag
     * @param string $selectorValue
     */
    public function testCanCheckPage(string $url, string $selectorTag, string $selectorValue)
    {
        $this->client->request(Request::METHOD_GET, $url);
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains($selectorTag, $selectorValue);
    }

    public function providerCheckPage(): Generator
    {
            #homepage
            yield ['/', '#home-button-register', 'Criar meu currículo 2020'];
            yield ['/en', '#home-button-register', 'Make my curriculum vitae 2020'];

            #user profile
            yield ['/test-mock', '#home-title', 'Test Mock'];
            yield ['/test-mock/en', '#home-title', 'Test Mock'];

            #create curriculum
            yield ['/test-mock/curriculum/pt_BR', '#name', 'Test Mock'];
            yield ['/test-mock/curriculum/en', '#name', 'Test Mock'];

            #login
            yield ['/pt_BR/login', '#page-title', 'Bem-vindo novamente!'];
            yield ['/en/login', '#page-title', 'Welcome back!'];

            #register
            yield ['/pt_BR/register', '#page-title', 'Registre-se'];
            yield ['/en/register', '#page-title', 'Hello, Friend!'];

            #reset-password
            yield ['/pt_BR/reset-password', '#page-title', 'Redefinir minha senha'];
            yield ['/en/reset-password', '#page-title', 'Reset your password'];
    }
}