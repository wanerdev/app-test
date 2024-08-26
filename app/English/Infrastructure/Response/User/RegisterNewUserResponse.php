<?php

namespace App\English\Infrastructure\Response\User;

class RegisterNewUserResponse
{
    private string $accessToken;
    private string $tokenType;
    private string $userName;

    public function __construct(string $accessToken, string $tokenType, string $userName)
    {
        $this->accessToken = $accessToken;
        $this->tokenType = $tokenType;
        $this->userName = $userName;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }
}
