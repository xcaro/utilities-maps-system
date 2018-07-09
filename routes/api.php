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
Route::post('password/forgot', 'ForgotPasswordController@getResetToken');
Route::post('password/reset', 'ResetPasswordController@reset');

// Route::resource('report-type', 'ReportTypeController');
// Route::resource('report', 'ReportController');
Route::get('clinic/me', 'ClinicController@myClinic')->name('clinic.me');
Route::get('clinic/{clinic}/shift/filter', 'ClinicController@filterByDate')->name('clinic.filterByDate');
// Route::put('shifts/{shifts}/shift/{shift}/confirm', 'UserTurnController@confirm')->name('turn.confirm');
// Route::put('shifts/{shifts}/shift/{shift}/unconfirm', 'UserTurnController@unconfirm')->name('turn.unconfirm');
Route::get('user/{user}/book', 'BookingController@shiftsOfUser');
Route::post('user/{user}/book', 'BookingController@bookShifts');
Route::get('shift/{shift}/user', 'BookingController@shiftsBooked');
Route::put('shift/{shift}/user/{user}/confirm', 'BookingController@confirmBooking');
Route::put('shift/{shift}/user/{user}/unconfirm', 'BookingController@unconfirmBooking');
Route::post('clinic/{clinic}/shift/multi', 'ClinicShiftController@multiShifts')->name('shift.mutli');
Route::get('user/booked', 'BookingController@confirmedShifts')->name('user.confirmed-shifts');
Route::apiResources([
	'report-type' => 'ReportTypeController',
	'report' => 'ReportController',
	'clinic-type' => 'ClinicTypeController',
	'clinic' => 'ClinicController',
	'clinic.shift' => 'ClinicShiftController',
	// 'shift.book' => 'BookingController',
]);
Route::put('report/{report}/confirm', 'ReportController@confirm')->name('report.confirm');
Route::put('report/{report}/unconfirm', 'ReportController@unconfirm')->name('report.unconfirm');

//User Api
Route::apiResource('user', 'UserController', ['except' => ['index', 'show', 'destroy']]);
Route::post('user/change-password', 'UserController@changePassword')->name('user.change-password');
Route::post('user/change-info', 'AuthController@changeInfo')->name('user.change-info');

Route::get('city', 'CityController@city')->name('city');
Route::get('district', 'CityController@district')->name('district');
Route::get('district/{district}/ward', 'CityController@ward')->name('ward');