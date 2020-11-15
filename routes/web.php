<?php

use App\Http\Controllers\SocialiteLoginController;
// App Controllers
use Illuminate\Support\Facades\Route;

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

Route::get('login/discord', [SocialiteLoginController::class, 'redirectToProvider']);
Route::get('login/discord/callback', [SocialiteLoginController::class, 'handleProviderCallback']);

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
