<?php

namespace App\English\Infrastructure\Mapper\User;

use App\English\Domain\Model\User\User;
use App\English\Infrastructure\Persistence\Eloquent\User\UserEloquent;
use Illuminate\Support\Facades\Hash;

class ModelToEloquentMapper
{
    public function execute(User $user, bool $toCreate): UserEloquent
    {
        $userEloquent = new UserEloquent();

        $userEloquent->id = $user->getId();
        $userEloquent->name = $user->getName();
        $userEloquent->email = $user->getEmail();
        if($toCreate) {
            $userEloquent->password = Hash::make($user->getPassword());
        }else{
            $userEloquent->password =$user->getPassword();
        }

        return $userEloquent;
    }
}
