<?php

use Illuminate\Http\Request;
use App\Http\Middleware\IsUser;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsOperator;
use App\Events\RegisteredNotifEvent;
use App\Models\MergeVariationOption;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsUserRegistered;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OperatorController;
use App\Http\Middleware\IsUserAuthenticated;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\BannerHomeController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\VariationOptionController;
use App\Http\Controllers\MergeVariationOptionController;

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

Route::get('/', [UserController::class, 'home'])->name('user-home');
Route::get('/product/detail-product/{productId}', [UserController::class, 'detailProduct'])->name('user-detail-product');
Route::get('/products/{product}/images', [VariationOptionController::class, 'getImagesByProduct']);

// ROLE:OPERATOR
Route::get('/operator', [OperatorController::class, 'index'])->name('operator-index')->middleware(IsOperator::class);
Route::post('/operator/{id}/update-proses', [OperatorController::class, 'updateProses'])->middleware(IsOperator::class);
Route::post('/operator/{id}/update-shipping', [OperatorController::class, 'updateShipping'])->middleware(IsOperator::class);
Route::post('/operator/{order}/update-completed', [OperatorController::class, 'updateCompleted'])->middleware(IsOperator::class);
Route::post('/operator/update-resi', [OperatorController::class, 'updateResi'])->name('update-resi')->middleware(IsOperator::class);
Route::post('/operator/response-operator/{id}', [OperatorController::class, 'responseOperator'])->middleware(IsOperator::class);
Route::get('/operator/profile', [ProfileController::class, 'indexOperator'])->name('profile.operator')->middleware(IsOperator::class);
Route::get('/operator/filter/{category}', [OperatorController::class, 'filterOrders']);

// AUTH
Route::get('/register', [AuthController::class, 'registerPage'])->name('user-register');
Route::post('/preRegister', [AuthController::class, 'preRegister'])->name('user-preRegister-act');
Route::post('/register', [AuthController::class, 'register'])->name('user-register-act');
Route::get('/forgot-password', [AuthController::class, 'forgotPasswordPage'])->name('user-forgot-password');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('user-forgot-password-act');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordPage'])->name('user-reset-password');
Route::put('reset-password/{token}', [AuthController::class, 'resetPassword'])->name('user-reset-password-act');
Route::get('/login', [AuthController::class, 'loginPage'])->name('user-login');
Route::post('/login', [AuthController::class, 'login'])->name('user-login-act');
Route::middleware(IsUserAuthenticated::class)->prefix('/auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('user-logout-act');
});
Route::middleware(IsUserRegistered::class)->group(function () {
    Route::get('/verify', [AuthController::class, 'verifyPage'])->name('user-verify');
});

//ROLE:ADMIN 
Route::middleware(IsAdmin::class)->prefix('/admin')->group(function () {
    #HOME ADMIN
    Route::get('/', [AdminUsersController::class, 'home'])->name('admin.home');
    Route::get('/profile', [ProfileController::class, 'indexAdmin'])->name('profile.admin');
    Route::put('/update-profile/{id}', [ProfileController::class, 'update']);

    # USERS + ALAMAT
    Route::get('/list-users', [AdminUsersController::class, 'index']);
    Route::get('/create-users', [AdminUsersController::class, 'create']);
    Route::post('/store-users', [AdminUsersController::class, 'store']);
    Route::get('/edit-users/{id}', [AdminUsersController::class, 'edit']);
    Route::put('/update-users/{id}', [AdminUsersController::class, 'update']);
    Route::delete('/delete-users/{id}', [AdminUsersController::class, 'destroy']);

    #CATEGORY
    Route::get('/list-category', [CategoryController::class, 'index']);
    Route::get('/create-category', [CategoryController::class, 'create']);
    Route::post('/store-category', [CategoryController::class, 'store']);
    Route::get('/edit-category/{id}', [CategoryController::class, 'edit']);
    Route::put('/update-category/{category}', [CategoryController::class, 'update']);
    Route::delete('/delete-category/{category}', [CategoryController::class, 'destroy']);

    #VARIATION
    Route::get('/list-variation', [VariationController::class, 'index']);
    Route::get('/create-variation', [VariationController::class, 'create']);
    Route::post('/store-variation', [VariationController::class, 'store']);
    Route::get('/edit-variation/{id}', [VariationController::class, 'edit']);
    Route::put('/update-variation/{variations}', [VariationController::class, 'update']);
    Route::delete('/delete-variation/{variations}', [VariationController::class, 'destroy']);

    #VARIATION OPTION
    Route::get('/list-variation-option', [VariationOptionController::class, 'index']);
    Route::get('/create-variation-option', [VariationOptionController::class, 'create']);
    Route::post('/store-variation-option', [VariationOptionController::class, 'store']);
    Route::get('/edit-variation-option/{id}', [VariationOptionController::class, 'edit']);
    Route::put('/update-variation-option/{variationOption}', [VariationOptionController::class, 'update']);
    Route::delete('/delete-variation-option/{variationOption}', [VariationOptionController::class, 'destroy']);

    #PRODUCT
    Route::get('/list-product', [ProductController::class, 'index']);
    Route::get('/create-product', [ProductController::class, 'create']);
    Route::post('/store-product', [ProductController::class, 'store']);
    Route::get('/edit-product/{id}', [ProductController::class, 'edit']);
    Route::put('/update-product/{product}', [ProductController::class, 'update']);
    Route::delete('/delete-product/{product}', [ProductController::class, 'destroy']);
    Route::get('/product/{id}/variations', [ProductController::class, 'getVariations']);

    #BANNER HOME
    Route::get('/list-banner', [BannerHomeController::class, 'index']);
    Route::get('/create-banner', [BannerHomeController::class, 'create']);
    Route::post('/store-banner', [BannerHomeController::class, 'store']);
    Route::get('/edit-banner/{id}', [BannerHomeController::class, 'edit']);
    Route::put('/update-banner/{bannerHome}', [BannerHomeController::class, 'update']);
    Route::delete('/delete-banner/{bannerHome}', [BannerHomeController::class, 'destroy']);

    #MERGE VARIATION OPTION
    Route::get('/list-merge-varOption', [MergeVariationOptionController::class, 'index']);
    Route::get('/create-merge-varOption', [MergeVariationOptionController::class, 'create']);
    Route::post('/store-merge-varOption', [MergeVariationOptionController::class, 'store']);
    Route::get('/edit-merge-varOption/{id}', [MergeVariationOptionController::class, 'edit']);
    Route::put('/update-merge-varOption/{id}', [MergeVariationOptionController::class, 'update']);
    Route::delete('/delete-merge-varOption/{product}', [MergeVariationOptionController::class, 'destroy']);
    Route::get('/getVarOption/{productId}', [MergeVariationOptionController::class, 'getVarOption']);

    #VOUCHER
    Route::get('/list-voucher', [VoucherController::class, 'index']);
    Route::get('/create-voucher', [VoucherController::class, 'create']);
    Route::post('/store-voucher', [VoucherController::class, 'store']);
    Route::get('/edit-voucher/{id}', [VoucherController::class, 'edit']);
    Route::put('/update-voucher/{voucher}', [VoucherController::class, 'update']);
    Route::delete('/delete-voucher/{voucher}', [VoucherController::class, 'destroy']);
    Route::post('/update-status-voucher/{id}', [VoucherController::class, 'updateStatus']);
});

//ROLE:USER
Route::prefix('/user')->group(function () {
    Route::middleware(IsUser::class)->group(function () {
        Route::get('/cart', [UserController::class, 'showCart'])->name('user-cart');
        Route::get('/profile', [UserController::class, 'profile'])->name('user-profile');
        Route::prefix('/product')->group(function () {
            Route::get('/order', [UserController::class, 'order'])->name('user-order');
            Route::get('/buy-now', [UserController::class, 'buyNow'])->name('user-buy-now');
            Route::get('/send-notif-payment', [UserController::class, 'sendNotifPa'])->name('send-notif-payment');
        });
    });
});