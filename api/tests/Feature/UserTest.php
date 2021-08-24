<?php

declare(strict_types=1);

use App\Entity\User;

it('can get user collection resource without any user log in.')
    ->get('/api/users')
    ->assertResponseIsSuccessful()
    ->expectResponseContent()
    ->json()
    ->toHaveKey('hydra:totalItems', 13)
    ->toMatchesResourceCollectionJsonSchema(User::class)
;

it('can get an user item resource without any user log in.')
    ->get('/api/users/1000')
    ->assertResponseIsSuccessful()
    ->expectResponseContent()
    ->toMatchesResourceItemJsonSchema(User::class)
    ->toMatchJsonSnapshot()
;
