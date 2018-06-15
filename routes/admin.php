<?php

//Route::get('/', 'DashboardController@dashboard');
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
	'rptype' => 'ReportTypeController'
]);
Route::put('reports/{report}/confirm', 'ReportController@confirm');