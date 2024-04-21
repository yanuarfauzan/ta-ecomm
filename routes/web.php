<?php

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

Route::middleware(['splade'])->group(function () {

    // ori splade start
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();
    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();
    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();
    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();
    // ori splade end

    Route::get('/test', function () {
        return view('user.test');
    });

    #ROLE:ADMIN = USERS + ALAMAT
    Route::get('/admin/list-users', [AdminController::class, 'index']);
    Route::get('/admin/create-users', [AdminController::class, 'create']);
    Route::post('/admin/store-users', [AdminController::class, 'store']);
    Route::get('/admin/edit-users/{id}', [AdminController::class, 'edit']);
    Route::put('/admin/update-users/{id}', [AdminController::class, 'update']);

    #ROLE:USER
    Route::get('/user/home', [UserController::class, 'home']);

});

