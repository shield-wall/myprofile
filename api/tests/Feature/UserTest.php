<?php

declare(strict_types=1);

use App\Entity\User;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

uses(RefreshDatabaseTrait::class);

it('can access the user collection as public resource.')
    ->get('/users')
    ->assertResponseIsSuccessful()
    ->expectResponseContent()
    ->json()
    ->toHaveKey('hydra:totalItems', 14)
    ->toMatchesResourceCollectionJsonSchema(User::class)
;

it('can access the user content as public resource.')
    ->get('/users/1000')
    ->assertResponseIsSuccessful()
    ->expectResponseContent()
    ->toMatchesResourceItemJsonSchema(User::class)
    ->toMatchJsonSnapshot()
;

test('required fields to create a new user.')
    ->post('/users', [])
    ->assertResourceIsUnprocessableEntity()
    ->expectResponseContent(false)
    ->toMatchJsonSnapshot()
;

test('can not register an user with email already used.')
    ->post('/users', [
        'email' => 'test@myprofile.pro',
        'firstName' => 'Fake',
        'lastName' => 'User',
        'password' => '12345678',
    ])
    ->assertResourceIsUnprocessableEntity()
    ->expectResponseContent(false)
    ->toMatchJsonSnapshot()
;

test('the password can not be less then 6 digits.')
    ->post('/users', [
        'email' => 'faker_111@myprofile.pro',
        'firstName' => 'Fake',
        'lastName' => 'User',
        'password' => '12345',
    ])
    ->assertResourceIsUnprocessableEntity()
    ->expectResponseContent(false)
    ->toMatchJsonSnapshot();

it('can create an user and check if he\'s login.')
    ->post('/users', [
        'email' => 'create.fake.user@myprofile.pro',
        'firstName' => 'Fake',
        'lastName' => 'User',
        'password' => '12345678',
    ])
    ->assertResponseIsSuccessful()
    ->post('/authentication_token', [
        'email' => 'create.fake.user@myprofile.pro',
        'password' => '12345678',
    ])
    ->assertResponseIsSuccessful()
;
