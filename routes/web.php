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
    return view('home');
});
Route::get('/index', function () {
	return view('admin.dashboard.index')->with('title', 'Trang chu');
});
Route::group([
	'prefix' => 'admin',
	'namespace' => 'Admin',
	'as' => 'admin.'
], function () {
	Route::get('/', [
		'uses' => 'LoginController@showLoginForm',
		'as' => 'login',
	]);
	Route::post('/', [
		'uses' => 'LoginController@login',
		'as' => 'check',
	]);
});

// Google+ login
Route::get('auth/redirect', 'AuthController@redirect');
Route::get('auth/callback', 'AuthController@callback');
Route::get('register', 'AuthController@signup')->name('signup.show');
Route::post('register', 'AuthController@register')->name('signup.store');