<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/user/pre-register', [AuthController::class, 'preRegister']);
Route::post('/user/register', [AuthController::class, 'register']);
Route::post('/user/login', [AuthController::class, 'login']);
Route::post('/user/logout', [AuthController::class, 'logout']);
Route::post('/user/forgot-password', [AuthController::class, 'forgotPassword']);
Route::put('/user/reset-password/{token}', [AuthController::class, 'resetPassword']);
