<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\CategoryController;

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
    Route::get('/admin/list-users', [AdminUsersController::class, 'index']);
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
});

