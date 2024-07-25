<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Front\FrontHomeController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//front
Route::prefix('front')->name('front.')->group(function () {
    Route::get('/', FrontHomeController::class)->middleware('auth')->name('home');

});





require __DIR__ . '/auth.php';

//admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', AdminHomeController::class)->middleware('admin')->name('home');
    Route::resource('users', \App\Http\Controllers\Admin\Users\UserController::class);
    Route::resource('admins', \App\Http\Controllers\Admin\admins\AdminController::class);
    Route::resource('roles', \App\Http\Controllers\Admin\roles\RoleController::class);

    require __DIR__ . '/adminAuth.php';

});
