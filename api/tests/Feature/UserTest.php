<?php

declare(strict_types=1);

use App\Entity\User;

use function Eerison\PestPluginApiPlatform\{
    get,
    findIriBy,
    assertResponseIsSuccessful,
    assertMatchesResourceItemJsonSchema
};

it('can get user collection resource without any user log in.')
    ->get('/api/users')
    ->assertResponseIsSuccessful()
    ->expectResponseContent()
    ->json()
    ->toHaveKey('hydra:totalItems', 13)
    ->toMatchesResourceCollectionJsonSchema(User::class)
;

it('can get an user item resource without any user log in.', function (): void {
    $iri = findIriBy(User::class, ['email' => 'test@myprofile.pro']);
    $content = get($iri)->getContent();
    assertResponseIsSuccessful();
    assertMatchesResourceItemJsonSchema(User::class);

    expect($content)
        ->json()
        ->toHaveKey('id')
        ->toHaveKey('email', 'test@myprofile.pro')
        ->toHaveKey('firstName', 'Test')
        ->toHaveKey('lastName', 'Mock')
        ->toHaveKey('slug', 'test-mock')
        ->toHaveKey('createdAt')
        ->toHaveKey('updatedAt')
        ->toHaveKey('profileImage')
        ->toHaveKey('backgroundImage')
    ;
});
