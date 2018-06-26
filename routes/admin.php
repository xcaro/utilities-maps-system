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
	'report' => 'ReportController',
	'rtype' => 'ReportTypeController',
	'user' => 'UserController',
	'role' => 'RoleController'
]);
Route::put('report/{report}/confirm', 'ReportController@confirm');
// Route::get('role', function(){
// 	return response()->json(Auth::user(), 200, [], JSON_PRETTY_PRINT);
// });
Route::get('pass', function(){
	return response()->json(Auth::user()->password, 200, [], JSON_PRETTY_PRINT);
});
