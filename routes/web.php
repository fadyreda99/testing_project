<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Front\FrontHomeController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Models\CK;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
    Route::get('ck', function () {
        $data = CK::get();
        return view('front.test.ck', compact('data'));
    });
    Route::post('ck', function (Request $request) {
        $data = $request->validate([
            'content' => 'required|string'
        ]);

        CK::create([
            'desc' => $request->content
        ]); // Store in the database

        return redirect()->back()->with('success', 'Content saved successfully!');
    })->name('ck');

    Route::post('upload', function (Request $request) {
        // Check if a file is present
        if (!$request->hasFile('upload')) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        $file = $request->file('upload');

        // Validate the file
        $validation = Validator::make($request->all(), [
            'upload' => 'required|image|mimes:jpeg,jpg,png,gif,jfif|max:2048',
        ]);

        if ($validation->fails()) {
            return response()->json(['error' => $validation->errors()->first()], 422);
        }

        // Store the file
        try {
            $path = $file->store('uploads/images', 'public');

            // Respond with the URL of the uploaded image
            return response()->json(['url' => asset('storage/' . $path)], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to upload image: ' . $e->getMessage()], 500);
        }
    })->name('ck.image.upload');
});






require __DIR__ . '/auth.php';

//admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', AdminHomeController::class)->middleware('admin')->name('home');
    Route::resource('users', \App\Http\Controllers\Admin\Users\UserController::class);
    Route::resource('admins', \App\Http\Controllers\Admin\admins\AdminController::class);
    Route::resource('roles', \App\Http\Controllers\Admin\roles\RoleController::class);

    Route::get('/testing', [\App\Http\Controllers\Admin\Users\UserController::class, 'testing']);

    require __DIR__ . '/adminAuth.php';
});
