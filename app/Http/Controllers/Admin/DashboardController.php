<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use App\Report;
class DashboardController extends Controller
{
	public function __construct()
    {
        $this->middleware('admin');
    }
    public function dashboard()
    {
        $today = Carbon::today();

        $totalClinicToday = \App\Clinic::whereDate('created_at', $today)->count();
        $totalReportToday = \App\Report::whereDate('created_at', $today)->count();
        
        $result = Report::select(\DB::raw('MONTH(created_at) as month, COUNT(*) as total'))->groupBy(\DB::raw('MONTH(created_at)'))->get();
        //return response()->json($result);
    	return view('admin.dashboard.index', [
    		'title' => 'Dashboard',
            'total_clinic_today' => $totalClinicToday,
            'total_report_today' => $totalReportToday,
    	]);
    }
}
