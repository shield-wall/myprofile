<?php

declare(strict_types=1);

it('can authenticate with email and password.', static function (): void {
    $response = post('/authentication_token', ['email' => 'admin@myprofile.pro', 'password' => '123456']);
    assertResponseIsSuccessful();

    expect($response->getContent())
        ->json()
        ->toHaveKey('token')
    ;

    $json = $response->toArray();

    get('social_networkings');
    assertResourceIsUnauthorized();

    get('social_networkings', ['auth_bearer' => $json['token']]);
    assertResponseIsSuccessful();
});
