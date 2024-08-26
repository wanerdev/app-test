<?php

namespace App\English\Infrastructure\Controller\User;

use App\English\Application\Exception\User\RegisterUserErrorInsertionException;
use App\English\Application\UseCase\User\RegisterNewUserUseCase;
use App\English\Infrastructure\Request\User\RegisterNewUserRequest;
use App\English\Infrastructure\RequestDTO\User\RegisterNewUserRequestDTO;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class RegisterNewUserController extends Controller
{
    public function __construct(
        private RegisterNewUserUseCase $registerNewUserUseCase,
    )
    {
    }

    public function __invoke(RegisterNewUserRequest $request):JsonResponse
    {
        try {
            $registerNewUserRequestDTO = new RegisterNewUserRequestDTO(
                $request->get('name'),
                $request->get('email'),
                $request->get('password'),
            );

            $registerResponse = $this->registerNewUserUseCase->execute($registerNewUserRequestDTO);

            return response()->json([
                'accessToken' => $registerResponse->getAccessToken(),
                'tokenType' => $registerResponse->getTokenType(),
                'userName' => $registerResponse->getUsername(),
                ],200);

        }catch (RegisterUserErrorInsertionException $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], $exception->getCode());
        }

    }
}
