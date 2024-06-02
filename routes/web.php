<?php

use Illuminate\Http\Request;
use App\Http\Middleware\IsUser;
use App\Events\RegisteredNotifEvent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsUserRegistered;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OperatorController;
use App\Http\Middleware\IsUserAuthenticated;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\BannerHomeController;

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

Route::get('/test-session', function () {
    Session::put(['test' => 'value test']);
});

    Route::get('/operator', [OperatorController::class, 'index']);
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
    
    #VARIATION
    Route::get('/admin/list-variation', [VariationController::class, 'index']);
    Route::get('/admin/create-variation', [VariationController::class, 'create']);
    Route::post('/admin/store-variation', [VariationController::class, 'store']);
    Route::get('/admin/edit-variation/{id}', [VariationController::class, 'edit']);
    Route::put('/admin/update-variation/{variations}', [VariationController::class, 'update']);
    Route::delete('/admin/delete-variation/{variations}', [VariationController::class, 'destroy']);
    
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
    
    #BANNER HOME
    Route::get('/admin/list-banner', [BannerHomeController::class, 'index']);
    Route::get('/admin/create-banner', [BannerHomeController::class, 'create']);
    Route::post('/admin/store-banner', [BannerHomeController::class, 'store']);
    Route::get('/admin/edit-banner/{id}', [BannerHomeController::class, 'edit']);
    Route::put('/admin/update-banner/{bannerHome}', [BannerHomeController::class, 'update']);
    Route::delete('/admin/delete-banner/{bannerHome}', [BannerHomeController::class, 'destroy']);

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
        Route::get('/profile', [UserController::class, 'profile'])->name('user-profile');
        Route::prefix('/product')->group(function () {
            Route::get('/detail-product/{productId}', [UserController::class, 'detailProduct'])->name('user-detail-product');
            Route::get('/order', [UserController::class, 'order'])->name('user-order');
            Route::get('/buy-now', [UserController::class, 'buyNow'])->name('user-buy-now');
            Route::get('/send-notif-payment', [UserController::class, 'sendNotifPa'])->name('send-notif-payment');
        });
    });
    
});

