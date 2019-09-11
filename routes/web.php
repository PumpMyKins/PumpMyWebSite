<?php

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

use Illuminate\Support\Str;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::prefix('forum')->group(function () {

	/*
	|--------------------------------------------------------------------------
	| Forum Routes
	|--------------------------------------------------------------------------
	|
	| Here are all the Forum routes registered using the resource helper and
	| exception of Index replace by tutorial and general (Main category) !
	|
	*/

	Route::resource('posts', 'PostController')->except(['index','show'])->middleware(['auth','verified']);
	Route::get('posts/{slug}', 'PostController@show')->name('posts.show');


	Route::get('tutorial', 'PostController@tutorial')->name('tutorial');

	Route::get('general', 'PostController@general')->name('general');

	Route::resource('support' , 'SupportsController')->except(['index'])->middleware(['auth','verified']);

	Route::resource('candidature', 'CandidaturesController')->middleware(['auth','verified']);
});

Route::resource('rules', 'RulesController')->except(['show','index'])->middleware(['auth', 'verified']);
Route::get('rules', 'RulesController@index')->name('rules.index');

Route::resource('servers', 'ServersController')->except(['show','index'])->middleware(['auth','verified']);
Route::get('servers', 'ServersController@index')->name('servers.index');
