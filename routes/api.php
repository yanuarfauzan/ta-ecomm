<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/user/pre-register', [AuthController::class, 'preRegister']);
Route::post('/user/register', [AuthController::class, 'register']);
Route::post('/user/login', [AuthController::class, 'login']);
Route::post('/user/logout', [AuthController::class, 'logout']);
Route::post('/user/forgot-password', [AuthController::class, 'forgotPassword']);
Route::put('/user/reset-password/{token}', [AuthController::class, 'resetPassword']);

Route::get('/user/list-admin', [AdminController::class, 'index']);
Route::get('/user/create-admin', [AdminController::class, 'create']);
Route::post('/user/store-admin', [AdminController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::post('/user/add-address', [UserController::class, 'addAddresses']);
    Route::get('/add-product-to-cart/{productId}', [UserController::class, 'addProductToCart'])->name('user-add-product-to-cart');
    Route::get('/user/add-product-to-fav/{productId}', [UserController::class, 'addProductToFav']);
    Route::get('/user/show-cart', [UserController::class, 'showCart']);
});
