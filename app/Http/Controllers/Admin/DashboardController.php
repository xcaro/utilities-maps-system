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
        //$result = \App\Report::select(\DB::raw('COUNT(*) as total'))->groupBy('type_id')->get();
        $report_current_year = \DB::table('report_types')->select(\DB::raw('COUNT(*) as total, report_types.name, report_types.id'))
        ->leftJoin('reports', 'report_types.id', '=', 'reports.type_id')
        ->whereYear('reports.created_at', $today->format('Y'))
        ->groupBy('report_types.id')
        ->get();
        //return response()->json($result, 200, [], JSON_PRETTY_PRINT);
    	return view('admin.dashboard.index', [
    		'title' => 'Dashboard',
            'total_clinic_today' => $totalClinicToday,
            'total_report_today' => $totalReportToday,
            'report_current_year' => $report_current_year,
    	]);
    }
}
