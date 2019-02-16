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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/panel', 'HomeController@index')
	->name('panel')
	->middleware('auth');

/*
|--------------------------------------------------------------------------
| Personal web Routes
|--------------------------------------------------------------------------
|
|  Here is where I register my own route, for staff, panel and other utilities
|
*/

/*ROUTE FOR NEWS */

Route::get('/news', 'NewsController@index')->name('list_news');
Route::group(['prefix' => 'news'], function(){
	Route::get('/show/{id}', 'NewsController@show')
		->name('show_news');
	Route::get('/create', 'NewsController@create')
		->name('create_news')
		->middleware('auth','can:propose_news');
	Route::post('/create', 'NewsController@store')
		->name('store_news')
		->middleware('auth','can:propose_news');
	Route::get('/edit/{news}', 'NewsController@edit')
		->name('edit_news')
		->middleware('auth','can:can_manage_news');
	Route::post('/edit/{news}', 'NewsController@update')
		->name('update_news')
		->middleware('auth','can:can_manage_news');
	Route::get('/publish/{news}', 'NewsController@publish')
		->name('publish_news')
		->middleware('auth','can:can_manage_news');
	Route::get('/draft', 'NewsController@draft')
		->name('list_draft')
		->middleware('auth','can:can_manage_news');
});

/* ROUTE FOR BasicPage */

Route::view('/legals', 'basicPage/legals');

/* ROUTE FOR THE PANEL */

Route::get('/panel/candidature/actual/', 'CandidatureController@indexActual')
	->name('candidature_list')
	->middleware('auth');
Route::get('/panel/candidature/old/', 'CandidatureController@indexOld')
	->name('candidature_list_old')
	->middleware('auth');
Route::group(['prefix' => 'panel/candidature'], function() {
	Route::get('show/{id}', 'CandidatureController@show')
		->name('show_candidature')
		->middleware('auth','can:staff');
	Route::get('/create', 'CandidatureController@create')
		->name('create_candidature')
		->middleware('auth','can:can_candidature');
	Route::post('/create', 'CandidatureController@store')
		->name('store_candidature')
		->middleware('auth','can:can_candidature');
	Route::get('/upvote/{candidature}', 'CandidatureController@upvote')
		->name('upvote_candidature')
		->middleware('auth','can:staff');
	Route::get('/downvote/{candidature}', 'CandidatureController@downvote')
		->name('downvote_candidature')
		->middleware('auth','can:staff');
	Route::get('/accept/{candidature}', 'CandidatureController@accept')
		->name('accept_candidature')
		->middleware('auth','can:can_promote');
	Route::get('/refuse/{candidature}', 'CandidatureController@refuse')
		->name('refuse_candidature')
		->middleware('auth','can:can_promote');
});

/*ROUTE FOR THE DIFFERENT LIST */

Route::get('/panel/liststaff/', 'PanelController@liststaff')
	->name('list_staff')
	->middleware('auth');
Route::get('/panel/listplayer/', 'PanelController@listplayer')
	->name('list_player')
	->middleware('auth');
Route::post('/panel/listplayer', 'PanelController@changeRole')
	->name('change_role')
	->middleware('auth', 'can:can_promote');

/*ROUTE FOR THE SERVERS */

Route::get('/servers', 'ServerController@index')->name('list_server');
Route::post('/servers', 'ServerController@indexWithResearch')->name('list_server_research');
Route::get('/servers/old', 'ServerController@oldIndex')->name('list_server_old');
Route::group(['prefix' => 'servers'], function(){
	Route::get('/show/{id}', 'ServerController@show')
		->name('show_server');
	Route::get('/create', 'ServerController@create')
		->name('create_server')
		->middleware('auth','can:universal_protection');
	Route::post('/create', 'ServerController@store')
		->name('store_server')
		->middleware('auth','can:universal_protection');
	Route::get('/edit/{server}', 'ServerController@edit')
		->name('edit_server')
		->middleware('auth','can:universal_protection');
	Route::post('/edit/{server}', 'ServerController@update')
		->name('update_server')
		->middleware('auth','can:universal_protection');
	Route::get('/publish/{server}', 'ServerController@publish')
		->name('publish_server')
		->middleware('auth','can:universal_protection');
	Route::get('/draft', 'ServerController@draft')
		->name('list_draft_server')
		->middleware('auth','can:universal_protection');
	Route::get('/delete/{server}', 'ServerController@delete')
		->name('delete_server')
		->middleware('auth','can:universal_protection');
	Route::get('/forceopen/{server}', 'ServerController@forceopen')
		->name('forceopen_server')
		->middleware('auth','can:universal_protection');
	Route::get('/close/{server}', 'ServerController@close')
		->name('close_server')
		->middleware('auth','can:universal_protection');
	Route::get('/reopen/{server}', 'ServerController@reopen')
		->name('reopen_server')
		->middleware('auth','can:universal_protection');
});

/*ROUTE FOR PROFILE */

Route::group(['prefix' => 'panel/profile'], function() {
	Route::get('/show/{id}', 'ProfileController@show')
		->name('show_profile')
		->middleware('auth');
	Route::get('/edit/{profile}', 'ProfileController@edit')
		->name('edit_profile')
		->middleware('auth','can:modify-profile,profile');
	Route::post('/edit/{profile}', 'ProfileController@update')
		->name('update_profile')
		->middleware('auth','can:modify-profile,profile');
	Route::get('/delete/{profile}', 'ProfileController@delete')
		->name('delete_profile')
		->middleware('auth', 'can:delete-profile,profile');
	Route::get('/create', 'ProfileController@create')
		->name('create_profile')
		->middleware('auth');
	Route::post('/create', 'ProfileController@store')
		->name('store_profile')
		->middleware('auth');
	
});