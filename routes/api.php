<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// 
Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');
Route::post('refresh', 'AuthController@refresh');
Route::post('me', 'AuthController@me');

// Route::resource('report-type', 'ReportTypeController');
// Route::resource('report', 'ReportController');

Route::apiResources([
	'report-type' => 'ReportTypeController',
	'report' => 'ReportController',
	'clinic-type' => 'ClinicTypeController',
	'clinic' => 'ClinicController',
	'clinic.shift' => 'ClinicShiftController',
	'user.turn' => 'UserTurnController',
]);
Route::put('report/{report}/confirm', 'ReportController@confirm')->name('report.confirm');
Route::put('report/{report}/unconfirm', 'ReportController@unconfirm')->name('report.unconfirm');

//User Api
Route::apiResource('user', 'UserController', ['except' => ['index', 'show', 'destroy']]);
Route::post('user/change-password', 'UserController@changePassword')->name('user.change-password');