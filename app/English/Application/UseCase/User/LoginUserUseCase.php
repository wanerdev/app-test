<?php

namespace App\English\Application\UseCase\User;

use App\English\Application\Exception\User\InvalidUserDataCredential;
use App\English\Infrastructure\RequestDTO\User\LoginUserRequestDTO;
use App\English\Infrastructure\Response\User\LoginUserResponse;
use Illuminate\Support\Facades\Auth;

class LoginUserUseCase
{

    public function __construct()
    {
    }

    /**
     * @throws InvalidUserDataCredential
     */
    public function execute(LoginUserRequestDTO $requestDTO): LoginUserResponse
    {
        $credentials = [
            'email' => $requestDTO->getEmail(),
            'password' => $requestDTO->getPassword()
        ];

        if(!Auth::attempt($credentials)){
            throw new InvalidUserDataCredential('Invalid credentials',400);
        }

        $user = Auth::user();

        $accessToken = $user->createToken('authToken')->plainTextToken;

        $tokenType = "Bearer";

        $userName = $user->name;

        return new LoginUserResponse($userName, $accessToken, $tokenType);

    }
}
