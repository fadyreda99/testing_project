<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\RobinHoodController;
use App\Http\Controllers\Api\SocialController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('categories', CategoriesController::class);
});
Route::get('auth/google', [SocialController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

Route::get('rh-generate-keys', [RobinHoodController::class, 'generateKeyPair']);
Route::get('rh-generate-sig', [RobinHoodController::class, 'generateSignature']);
Route::get('rh-trading-pairs', [RobinHoodController::class, 'getTradingPairs']);
Route::get('testGenerateSignature', [RobinHoodController::class, 'testGenerateSignature']);
Route::get('get-accounnt', [RobinHoodController::class, 'getAccounts']);
