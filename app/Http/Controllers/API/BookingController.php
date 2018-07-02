<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClinicShift as ClinicShiftResource;
use App\Http\Resources\ClinicShiftCollection;
use App\User;
use App\ClinicShift;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function shiftsOfUser($user_id)
    {
    	$user = User::findOrFail($user_id);
    	return new ClinicShiftCollection($user->shifts);
    }

    public function bookShifts(Request $request, $user_id)
    {
    	$user = User::findOrFail($user_id);
    	$user->shifts()->attach($request->shifts_id);
    	return response()->json([
            'message' => 'Booking successful',
            'data' => new ClinicShiftCollection($user->shifts)
        ], 201);
    }
    public function shiftsBooked($shift_id)
    {
    	$shifts = \App\ClinicShift::findOrFail($shift_id);
    	return response()->json([
    		'data' => $shifts->users
    	], 200);
    }
    public function confirmBooking($shift_id, $user_id)
    {
    	$shift = \App\ClinicShift::findOrFail($shift_id);
    	$shift->users()->updateExistingPivot($user_id, ['confirmed' => true]);
    	return response()->json([
            'message' => 'Confirmed',
        ], 200);
    }
    public function unconfirmBooking($shift_id, $user_id)
    {
    	$shift = \App\ClinicShift::findOrFail($shift_id);
    	$shift->users()->updateExistingPivot($user_id, ['confirmed' => false]);
    	return response()->json([
            'message' => 'Unconfirmed',
        ], 200);
    }
}
