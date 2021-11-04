<?php

declare(strict_types=1);

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;

use function Eerison\PestPluginApiPlatform\{post, assertResponseStatusCodeSame};

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

/**
 * @TODO use the shortcut for response code when this issue be resolved
 *      https://github.com/eerison/pest-plugin-api-platform/issues/15
 */
test('can not register an user with invalid data.', function () {
    $response = post('/users', ['email' => 'test@test.com']);
    assertResponseStatusCodeSame(Response::HTTP_UNPROCESSABLE_ENTITY);

    expect($response->getContent(false))
        ->toMatchJsonSnapshot();
});
