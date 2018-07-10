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
        $list_type = \App\ClinicType::where('active', true)->get();

    	// $result = \App\Clinic::with(['shifts' => function($q) {
    	// 	return $q->withCount('usersConfirmed');
    	// }])->get();
    	// $result = \DB::table('clinic_shifts')
    	// 	//->leftJoin('clinic_shifts', 'clinics.id', '=', 'clinic_shifts.clinic_id')
    	// 	->leftJoin('shift_user', 'shift_user.shift_id', '=', 'clinic_shifts.id')
    	// 	->groupBy(\DB::raw('clinic_shifts.id'))
    	// 	->select(\DB::raw('clinic_shifts.id, COUNT(shift_user.confirmed) as total'))
    	// 	->get();

    	$shift_every_month = \DB::table('clinic_types')
    	->leftJoin('clinics', 'clinic_types.id', '=', 'clinics.type')
    	->leftJoin('clinic_shifts', 'clinics.id', '=', 'clinic_shifts.clinic_id')
    	->leftJoin('shift_user', 'clinic_shifts.id', '=', 'shift_user.shift_id')
    	->where('shift_user.confirmed', true)
    	->groupBy(\DB::raw('clinic_types.id, MONTH(`shift_user`.`created_at`)'))
        ->orderBy(\DB::raw('MONTH(`shift_user`.`created_at`),clinic_types.id'))
    	->select(\DB::raw('clinic_types.id,COUNT(*) as total, MONTH(`shift_user`.`created_at`) as month'))
    	->get();

        $clinic_every_month = \App\Clinic::groupBy(\DB::raw('MONTH(`created_at`)'))->select(\DB::raw('MONTH(`created_at`) as month, COUNT(*) as total'))->get();
    	//return response()->json($clinic_every_month, 200, [], JSON_PRETTY_PRINT);
    	return view('admin.clinic.statistic', [
            'list_type' => $list_type,
            'shift_every_month' => $shift_every_month,
            'clinic_every_month' => $clinic_every_month,
    	]);
    }
}
