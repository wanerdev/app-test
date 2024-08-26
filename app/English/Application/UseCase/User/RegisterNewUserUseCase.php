<?php

namespace App\English\Application\UseCase\User;

use App\English\Application\Exception\User\RegisterUserErrorInsertionException;
use App\English\Domain\Model\User\User;
use App\English\Infrastructure\Mapper\User\ModelToEloquentMapper;
use App\English\Infrastructure\RequestDTO\User\RegisterNewUserRequestDTO;
use App\English\Infrastructure\Response\User\RegisterNewUserResponse;

class RegisterNewUserUseCase
{
    public function __construct(
        private ModelToEloquentMapper  $mapper,
    )
    {
    }

    /**
     * @throws RegisterUserErrorInsertionException
     */
    public function execute(RegisterNewUserRequestDTO $request): RegisterNewUserResponse
    {
        $user = new User(
            NULL,
            $request->getName(),
            $request->getEmail(),
            $request->getPassword(),
        );

        $userEloquent = $this->mapper->execute($user,true);

        $correctInsertion = $userEloquent->save();

        if(!$correctInsertion){
            throw new RegisterUserErrorInsertionException('Error in registration',400);
        }

        $accessToken = $userEloquent->createToken('authToken')->plainTextToken;
        $tokenType = "Bearer";
        $userName = $userEloquent->name;

        return new RegisterNewUserResponse(
            $accessToken,
            $tokenType,
            $userName
        );

    }

}
