<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SiteControllerTest extends WebTestCase
{
    public function testCanSeeHomePage()
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, '/');
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        $crawler = $client->request(Request::METHOD_GET, '/en');
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertGreaterThan(0, $crawler->filter('#example-of-users .column')->count());
    }

    public function testCanSeeUserProfilePage()
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, '/test-mock');
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('#home-title', 'Test Mock');

        $client->request(Request::METHOD_GET, '/test-mock/en');
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('#home-title', 'Test Mock');
    }

    public function testCanSeeCurriculumPage()
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, '/test-mock/curriculum/pt_BR');
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('#name', 'Test Mock');

        $client->request(Request::METHOD_GET, '/test-mock/curriculum/en');
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('#name', 'Test Mock');
    }

}