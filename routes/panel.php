<?php

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

/* Anyone including guests */
Route::get('/', function () {return redirect(route('panel.dashboard'));})->name('panel'); // Default panel page
Route::get('/dashboard', 'PanelController@dashboard')->name('panel.dashboard');
Route::get('/servers', 'PanelController@servers')->name('panel.servers');
Route::get('/infos' , 'PanelController@infos')->name('panel.infos');

/* Any user */
Route::get('/account' , 'AccountController@show')->name('panel.account');
Route::post('/account' , 'AccountController@update')->name('panel.account.update');

/* Only for permissions : manage user and roles: fondateur, responsable */
Route::get('/accounts' , 'AccountController@showAll')->name('panel.account.all');
Route::get('/accounts/{id}' , 'AccountController@getAccount')->name('panel.getAccount');
Route::post('/accounts/{id}' , 'AccountController@updateAccount')->name('panel.updateAccount');

/* Only for logged in users */
Route::get('/api', 'PanelController@api')->name('panel.api');
