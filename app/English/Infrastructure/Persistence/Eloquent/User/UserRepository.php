<?php

namespace App\English\Infrastructure\Persistence\Eloquent\User;

use App\English\Domain\Model\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function findByEmail($email): ?UserEloquent
    {
        Return UserEloquent::where('email', $email)
            ->firstOrFail();
    }
}
