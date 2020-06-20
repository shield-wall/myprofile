<?php

namespace App\Tests\Functional\Authentication;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterPageTest extends WebTestCase
{
    public function testThereAreRequiredTexts()
    {
        $client = static::createClient();
        $client->request('GET', '/en/register/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextSame('#page-title', 'Sign up');
    }
}