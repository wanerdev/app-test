<?php

namespace App\English\Infrastructure\Controller\User;

use App\English\Application\Exception\User\InvalidUserDataCredential;
use App\English\Application\UseCase\User\LoginUserUseCase;
use App\English\Infrastructure\Request\User\LoginUserRequest;
use App\English\Infrastructure\RequestDTO\User\LoginUserRequestDTO;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class LoginUserController extends Controller
{
    public function __construct(
        private  LoginUserUseCase $loginUserUseCase,
    )
    {
    }

    public function __invoke(LoginUserRequest $request): JsonResponse
    {
        try {

            $loginUserDTO = new LoginUserRequestDTO(
                $request->get('email'),
                $request->get('password')
            );

            $loginResponse = $this->loginUserUseCase->execute($loginUserDTO);

            return response()->json([
                'accessToken' => $loginResponse->getAccessToken(),
                'tokenType' => $loginResponse->getTokenType(),
                'userName' => $loginResponse->getUserName()
            ], 200);

        } catch (InvalidUserDataCredential $exception) {

            return response()->json([
                'error' => $exception->getMessage()
            ], $exception->getCode());
        }
    }
}
