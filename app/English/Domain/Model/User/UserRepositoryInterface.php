<?php

namespace App\English\Domain\Model\User;

use App\English\Infrastructure\Persistence\Eloquent\User\UserEloquent;

interface UserRepositoryInterface
{
    public function findByEmail($email): ?UserEloquent;
}
