<?php

declare(strict_types=1);

use App\Entity\User;

it('can get user collection resource without any user log in.')
    ->get('/users')
    ->assertResponseIsSuccessful()
    ->expectResponseContent()
    ->json()
    ->toHaveKey('hydra:totalItems', 14)
    ->toMatchesResourceCollectionJsonSchema(User::class)
;

it('can get an user item resource without any user log in.')
    ->get('/users/1000')
    ->assertResponseIsSuccessful()
    ->expectResponseContent()
    ->toMatchesResourceItemJsonSchema(User::class)
    ->toMatchJsonSnapshot()
;
