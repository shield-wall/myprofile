<?php

declare(strict_types=1);

namespace App\Tests\Feature;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\User;

/**
 * Class UsersTest
 * @package App\Tests\Feature
 *
 * @covers \App\Entity\User
 * @group user
 * @testdox User resource
 */
class UsersTest extends ApiTestCase
{
    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     *
     * @testdox has returned collection using anonymous context
     */
    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/api/users');
        $this->assertResponseIsSuccessful();

        $this->assertCount(13, $response->toArray()['hydra:member']);
        $this->assertMatchesResourceCollectionJsonSchema(User::class);
    }
}
