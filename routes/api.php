<?php

use App\English\Infrastructure\Controller\User\LoginUserController;
use App\English\Infrastructure\Controller\User\RegisterNewUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/loginUser', LoginUserController::class);

Route::post('/registerNewUser',RegisterNewUserController::class);
