<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
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

// User
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::match(['get', 'patch', 'delete'], '/user/{id?}', [UserController::class, 'match']);
    Route::get('/user/{id}/discord', [UserController::class, 'getDiscord']);
    Route::get('/users/{ids?}', [UserController::class, 'getUsers']);
    Route::post('/user', [UserController::class, 'createUser']);
});

// News
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::match(['get', 'patch', 'delete'], '/news/{id?}', [NewsController::class, 'match']);
    Route::post('/news', [NewsController::class, 'createNews']);
});
