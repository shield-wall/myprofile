<?php

declare(strict_types=1);

it('is returning a successful response', static function (string $url): void {
    get($url);
    assertResponseIsSuccessful();
})->with([
        '/users',
        static fn () => findIriBy(User::class, ['email' => 'test@myprofile.pro']),
]);
