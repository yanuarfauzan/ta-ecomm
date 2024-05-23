<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminUsersController;

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

