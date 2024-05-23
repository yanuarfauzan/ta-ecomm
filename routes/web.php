<?php

use Illuminate\Http\Request;
use App\Http\Middleware\IsUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsUserRegistered;
use App\Http\Middleware\IsUserAuthenticated;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    //ROLE:ADMIN 
    # USERS + ALAMAT
    Route::get('/admin/list-users', [AdminUsersController::class, 'index'])->name('admin.list.users');
    Route::get('/admin/create-users', [AdminUsersController::class, 'create']);
    Route::post('/admin/store-users', [AdminUsersController::class, 'store']);
    Route::get('/admin/edit-users/{id}', [AdminUsersController::class, 'edit']);
    Route::put('/admin/update-users/{id}', [AdminUsersController::class, 'update']);
    Route::delete('/admin/delete-users/{id}', [AdminUsersController::class, 'destroy']);

    #CATEGORY
    Route::get('/admin/list-category', [CategoryController::class, 'index']);
    Route::get('/admin/create-category', [CategoryController::class, 'create']);
    Route::post('/admin/store-category', [CategoryController::class, 'store']);
    Route::get('/admin/edit-category/{id}', [CategoryController::class, 'edit']);
    Route::put('/admin/update-category/{category}', [CategoryController::class, 'update']);
    Route::delete('/admin/delete-category/{category}', [CategoryController::class, 'destroy']);
    
    #PRODUCT
    Route::get('/admin/list-product', [ProductController::class, 'index']);
    Route::get('/admin/create-product', [ProductController::class, 'create']);
    Route::post('/admin/store-product', [ProductController::class, 'store']);
    Route::get('/admin/edit-product/{id}', [ProductController::class, 'edit']);
    Route::put('/admin/update-product/{product}', [ProductController::class, 'update']);
    Route::delete('/admin/delete-product/{product}', [ProductController::class, 'destroy']);
    
    #VOUCHER
    Route::get('/admin/list-voucher', [VoucherController::class, 'index']);
    Route::get('/admin/create-voucher', [VoucherController::class, 'create']);
    Route::post('/admin/store-voucher', [VoucherController::class, 'store']);
    Route::get('/admin/edit-voucher/{id}', [VoucherController::class, 'edit']);
    Route::put('/admin/update-voucher/{voucher}', [VoucherController::class, 'update']);
    Route::delete('/admin/delete-voucher/{voucher}', [VoucherController::class, 'destroy']);


#ROLE:USER
Route::prefix('/user')->group(function () {
    Route::middleware(IsUserAuthenticated::class)->prefix('/auth')->group(function () {
        Route::get('/register', [AuthController::class, 'registerPage'])->name('user-register');
        Route::post('/preRegister', [AuthController::class, 'preRegister'])->name('user-preRegister-act');
        Route::post('/register', [AuthController::class, 'register'])->name('user-register-act');
        Route::middleware(IsUserRegistered::class)->group(function () {
            Route::get('/verify', [AuthController::class, 'verifyPage'])->name('user-verify');
        });        
        Route::get('/forgot-password', [AuthController::class, 'forgotPasswordPage'])->name('user-forgot-password');
        Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('user-forgot-password-act');
        Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordPage'])->name('user-reset-password');
        Route::put('reset-password/{token}', [AuthController::class, 'resetPassword'])->name('user-reset-password-act');
        Route::get('/login', [AuthController::class, 'loginPage'])->name('user-login');
        Route::post('/login', [AuthController::class, 'login'])->name('user-login-act');
    });
    Route::middleware(IsUser::class)->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('user-logout-act');
        Route::get('/cart', [UserController::class, 'showCart'])->name('user-cart');
        Route::get('/home', [UserController::class, 'home'])->name('user-home');
        Route::prefix('/product')->group(function () {
            Route::get('/detail-product/{productId}', [UserController::class, 'detailProduct'])->name('user-detail-product');
            Route::get('/order', [UserController::class, 'order'])->name('user-order');
            Route::get('/buy-now', [UserController::class, 'buyNow'])->name('user-buy-now');
        });
    });

});

