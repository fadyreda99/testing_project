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
    Route::view('/login', 'front.auth.login')->name('login');
    Route::view('/register', 'front.auth.register')->name('register');
    Route::view('/forget-password', 'front.auth.forget-password')->name('forget-password');
});

// Route::group(
//     [
//         'prefix' => LaravelLocalization::setLocale(),
//         'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
//     ],
//     function () { //...
//         Route::get('/posts', [PostController::class, 'index'])->middleware('auth')->name('posts.index');
//         Route::get('/collection', [PostController::class, 'testCollection'])->middleware('auth')->name('posts.collection');
//         Route::post('/post/store', [PostController::class, 'store'])->middleware('auth')->name('posts.store');

//         Route::get('/user/{id}', [UserController::class, 'show'])->middleware('auth')->name('user.show');

//         Route::get('/dashboard', function () {
//             return view('dashboard');
//         })->middleware(['auth', 'verified'])->name('dashboard');

//         Route::middleware('auth')->group(function () {
//             Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//             Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//             Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//         });
//     }
// );



require __DIR__ . '/auth.php';

//admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', AdminHomeController::class)->middleware('admin')->name('home');
//    Route::view('/adlogin', 'admin.auth.login')->name('login');
    Route::view('/login', 'admin.auth.login')->name('login');
    Route::view('/register', 'admin.auth.register')->name('register');
    Route::view('/forget-password', 'admin.auth.forget-password')->name('forget-password');
});
