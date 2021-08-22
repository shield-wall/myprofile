<?php

declare(strict_types=1);

use App\Entity\User;

use function Eerison\PestPluginApiPlatform\{
    get,
    findIriBy,
    assertResponseIsSuccessful
};

it('is returning a successful response', function (string $url): void {
    get($url);
    assertResponseIsSuccessful();
})->with([
        '/api/users',
        fn() => findIriBy(User::class, ['email' => 'test@myprofile.pro']),
]);
