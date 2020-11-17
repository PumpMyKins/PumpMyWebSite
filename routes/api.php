<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Users
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::match(['get', 'patch', 'delete'], '/users/{id?}', [UserController::class, 'match']);
    Route::post('/users', [UserController::class, 'createUser']);
});

// User
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user/{id}/discord', [UserController::class, 'getDiscord']);
    Route::get('/user/{id?}', [UserController::class, 'getUser']);
});

// News
Route::group(['middleware' => 'auth:sanctum'], function() {
	Route::match(['get', 'patch', 'delete'], '/news/{id?}', [NewsController::class, 'match']);
	Route::post('/news', [NewsController::class, 'createNews']);
});
