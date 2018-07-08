<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class StatisticController extends Controller
{
    public function clinic()
    {
    	$today = Carbon::today();

    	// $result = \App\Clinic::with(['shifts' => function($q) {
    	// 	return $q->withCount('usersConfirmed');
    	// }])->get();
    	// $result = \DB::table('clinic_shifts')
    	// 	//->leftJoin('clinic_shifts', 'clinics.id', '=', 'clinic_shifts.clinic_id')
    	// 	->leftJoin('shift_user', 'shift_user.shift_id', '=', 'clinic_shifts.id')
    	// 	->groupBy(\DB::raw('clinic_shifts.id'))
    	// 	->select(\DB::raw('clinic_shifts.id, COUNT(shift_user.confirmed) as total'))
    	// 	->get();

    	$result = \DB::table('clinic_types')
    	->leftJoin('clinics', 'clinic_types.id', '=', 'clinics.type')
    	->leftJoin('clinic_shifts', 'clinics.id', '=', 'clinic_shifts.clinic_id')
    	->leftJoin('shift_user', 'clinic_shifts.id', '=', 'shift_user.shift_id')
    	->where('shift_user.confirmed', true)
    	->groupBy(\DB::raw('clinic_types.id, clinic_types.name'))
    	->select(\DB::raw('clinic_types.id,clinic_types.name,COUNT(*) as total'))
    	->get();

    	return response()->json($result, 200, [], JSON_PRETTY_PRINT);
    	return view('admin.clinic.statistic', [

    	]);
    }
}
