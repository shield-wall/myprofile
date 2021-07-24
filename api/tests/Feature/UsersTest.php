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
 */
class UsersTest extends ApiTestCase
{
    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/api/users');
        $this->assertResponseIsSuccessful();

        $this->assertCount(13, $response->toArray()['hydra:member']);
        $this->assertMatchesResourceCollectionJsonSchema(User::class);
    }
}
