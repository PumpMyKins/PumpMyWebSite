<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\UserController;

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

	//Route::get('/users/{ids?}', [UserController::class, 'getUsers']);
	Route::post('/users', [UserController::class, 'create']);
	//Route::patch('/users/{$id}', [UserController::class, 'patch']);
	//Route::delete('/users/{$id}', [UserController::class, 'delete']);
});

// User
Route::group(['middleware' => 'auth:sanctum'], function () {
	Route::get('/user/{id}/discord', [UserController::class, 'getDiscord']);
	Route::get('/user/{id?}', [UserController::class, 'getUser']);
});
