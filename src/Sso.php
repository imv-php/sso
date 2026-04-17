<?php

namespace Imv\Sso;

use Imv\Sso\Connectors\SsoConnector;
use Imv\Sso\DTO\SignDTO;
use Imv\Sso\DTO\TokenDTO;
use Imv\Sso\DTO\UserDTO;
use Imv\Sso\Requests\AuthorizationCodeRequest;
use Imv\Sso\Requests\IntrospectTokenRequest;
use Imv\Sso\Requests\RefreshTokenRequest;
use Imv\Sso\Requests\SignRequest;

class Sso
{
    private SsoConnector $connector;

    public function __construct()
    {
        $this->connector = new SsoConnector;
    }

    public function getUserData(string $access_token): UserDTO
    {
        return $this->introspectToken($access_token);
    }

    public function getToken(string $redirectUrl, string $code, string $codeVerifier): TokenDTO
    {
        $response = $this->connector->send(
            new AuthorizationCodeRequest($code, $codeVerifier, $redirectUrl)
        );

        return TokenDTO::fromResponse($response);
    }

    public function introspectToken(string $accessToken): UserDTO
    {
        $response = $this->connector->send(
            new IntrospectTokenRequest($accessToken)
        );

        return UserDTO::fromResponse($response);
    }

    public function sign(string $accessToken, string $doc)
    {
        $response = $this->connector->send(
            new SignRequest($doc, $accessToken)
        );

        return SignDTO::fromResponse($response);
    }

    public function refreshAccessToken(string $refreshToken): TokenDTO
    {
        $response = $this->connector->send(
            new RefreshTokenRequest($refreshToken)
        );

        return TokenDTO::fromResponse($response);
    }
}
