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
Route::get('clinic/statistic', 'StatisticController@clinic')->name('clinic.statistic');
Route::put('clinic/{clinic}/confirm', 'ClinicController@confirm')->name('clinic.confirm');
Route::put('clinic/{clinic}/unconfirm', 'ClinicController@unconfirm')->name('clinic.unconfirm');
Route::post('clinic/filter', 'ClinicController@filter')->name('clinic.filter');
Route::get('user/search', 'UserController@search')->name('user.search');
Route::get('setting', 'SettingController@index')->name('setting.index');
Route::post('setting', 'SettingController@update')->name('setting.update');
// Route::get('ctyte', 'ClinicTypeController@index')->name('admin.ctype.index');
Route::resources([
	//'rtype' => 'ReportTypeController',
	'user' => 'UserController',
	'role' => 'RoleController',
	'clinic' => 'ClinicController',
]);
Route::put('report/{report}/confirm', 'ReportController@confirm')->name('report.confirm');
Route::put('report/{report}/unconfirm', 'ReportController@unconfirm')->name('report.unconfirm');
Route::post('report/filter', 'ReportController@filter')->name('report.filter');
// Route::get('role', function(){
// 	return response()->json(Auth::user(), 200, [], JSON_PRETTY_PRINT);
// });
Route::get('pass', function(){
	return response()->json(Auth::user()->password, 200, [], JSON_PRETTY_PRINT);
});

Route::resource('report', 'ReportController', [
	'except' => [
		'create', 'store', 'show', 'edit', 'update',
	]
]);
Route::resource('rtype', 'ReportTypeController', [
	'except' => [
		'create', 
	]
]);
Route::resource('ctype', 'ClinicTypeController', [
	'except' => [
		'create', 
	]
]);