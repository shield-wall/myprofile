<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SiteControllerTest extends WebTestCase
{
    public function testCanSeeHomePages()
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, '/');
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}