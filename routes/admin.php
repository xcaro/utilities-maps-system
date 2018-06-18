<?php

//Route::get('/', 'DashboardController@dashboard');
Route::post('logout', 'LoginController@logout')->name('logout');
Route::group([
	'prefix' => 'dashboard'
], function () {
	Route::get('/', [
		'uses' => 'DashboardController@dashboard',
		'as' => 'dashboard',
	]);
});

Route::resources([
	'reports' => 'ReportController',
	'rptype' => 'ReportTypeController',
	'user' => 'UserController'
]);
Route::put('reports/{report}/confirm', 'ReportController@confirm');