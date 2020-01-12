<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserLanguageIntegrationTest extends WebTestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = static::createClient([], [
            'PHP_AUTH_USER' => 'username',
            'PHP_AUTH_PW'   => 'pa$$word',
        ]);
    }

    public function testListLanguages()
    {
        $this->client->request('GET', '/user/language/');

        var_dump($this->client->getResponse());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}