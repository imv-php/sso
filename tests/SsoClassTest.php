<?php

use Imv\Sso\DTO\SignDTO;
use Imv\Sso\DTO\TokenDTO;
use Imv\Sso\DTO\UserDTO;
use Imv\Sso\Facades\Sso as SsoFacade;
use Imv\Sso\Sso;

const REDIRECT_URL = '';
const CODE = '';
const CODE_VERIFIER = '';

$shared = new stdClass;
$shared->token_dto = new TokenDTO(
    access_token: '',
    refresh_token: '',
    expires_in: 0,
);
$shared->doc = '';

it('can create object', function () {
    $app = app(Sso::class);

    expect($app)->toBeInstanceOf(Sso::class);
});

test('can get access and refresh tokens', function () use ($shared) {
    $token = SsoFacade::getToken(REDIRECT_URL, CODE, CODE_VERIFIER);

    $shared->token_dto = $token;

    expect($token)
        ->toBeInstanceOf(TokenDTO::class)
        ->toHaveProperty('access_token')
        ->toHaveProperty('refresh_token')
        ->toHaveProperty('expires_in');
});

it('can get user info by access token', function () use ($shared) {
    $user = SsoFacade::getUserData($shared->token_dto->access_token);

    expect($user)->toBeInstanceOf(UserDTO::class);
});

it('can sign with doc', function () use ($shared) {
    $res = SsoFacade::sign($shared->token_dto->access_token, $shared->doc);

    expect($res)->toBeInstanceOf(SignDTO::class);
});
