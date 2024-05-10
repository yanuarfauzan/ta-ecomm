<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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

    Route::get('/test', function (Request $request) {
        dd($request->all());
        return view('user.test');
    });

    #ROLE:ADMIN = USERS + ALAMAT
    Route::get('/admin/list-users', [AdminController::class, 'index'])->name('admin-list-user');
    Route::get('/admin/create-users', [AdminController::class, 'create']);
    Route::post('/admin/store-users', [AdminController::class, 'store']);
    Route::get('/admin/edit-users/{id}', [AdminController::class, 'edit']);
    Route::put('/admin/update-users/{id}', [AdminController::class, 'update']);
    
    #ROLE:USER
    Route::prefix('/user')->group(function () {
        Route::get('/cart', [UserController::class, 'showCart'])->name('user-cart');
        Route::get('/home', [UserController::class, 'home'])->name('user-home');
        Route::prefix('/product')->group(function () {
            Route::get('/detail-product/{productId}', [UserController::class, 'detailProduct'])->name('user-detail-product');
        });
    });
