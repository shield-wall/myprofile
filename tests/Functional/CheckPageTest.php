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
     */
    public function testCanCheckPage(string $url, string $selectorTag)
    {
        $this->client->request(Request::METHOD_GET, $url);
        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists($selectorTag);
    }

    public function providerCheckPage(): Generator
    {
            #homepage
            yield ['/', '#logo'];
            yield ['/en', '#logo'];

            #user profile
            yield ['/test-mock', '#home-title'];
            yield ['/test-mock/en', '#home-title'];

            #create curriculum
            yield ['/test-mock/curriculum/pt_BR', '#name'];
            yield ['/test-mock/curriculum/en', '#name'];

            #login
            yield ['/login/pt_BR', '#logo'];
            yield ['/login/en', '#logo'];

            #privacy-policy
            yield ['/pt_BR/privacy-policy', '#logo'];
            yield ['/en/privacy-policy', '#logo'];
    }
}