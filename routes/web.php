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
	Route::post('login', [
		'uses' => 'LoginController@login',
		'as' => 'check',
	]);
});
Route::get('/test', function(){
	// Connect to localhost
    $conn = r\connect('localhost');

    // Create a test table
    r\db("app")->tableCreate("tablePhpTest")->run($conn);
	return dd(1);
});