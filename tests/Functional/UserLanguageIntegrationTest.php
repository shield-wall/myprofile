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
            'PHP_AUTH_PW' => 'pa$$word',
        ]);
    }

    public function testListLanguages()
    {
        $client = static::createClient();
        $client->request('GET', '/en/register');
        $this->assertNotEquals(500, $client->getResponse()->getStatusCode());
    }
}