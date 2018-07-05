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

        $totalUsers = \App\User::count();
        $totalClinicToday = \App\Clinic::whereDate('created_at', $today)->count();
        $totalReportToday = \App\Report::whereDate('created_at', $today)->count();
        $totalShifts = \App\ClinicShift::whereDate('created_at', $today)->count();
        // $result = Report::select(\DB::raw('MONTH(created_at) as month, COUNT(*) as total'))->groupBy(\DB::raw('MONTH(created_at)'))->get();
        //$result = \App\Report::select(\DB::raw('COUNT(*) as total'))->groupBy('type_id')->get();
        // $report_current_year = \DB::table('report_types')->select(\DB::raw('COUNT(*) as total, report_types.name, report_types.id'))
        // ->leftJoin('reports', 'report_types.id', '=', 'reports.type_id')
        // ->whereYear('reports.created_at', $today->format('Y'))
        // ->groupBy('report_types.id')
        // ->get();

        $report_every_month = Report::select(\DB::raw('`type_id`, MONTH(`created_at`) as month, COUNT(*) as total'))->whereYear('created_at', $today->format('Y'))->groupBy(\DB::raw('`type_id`, MONTH(`created_at`)'))->get();

        $report_current_year = \App\ReportType::withCount(['reports' => function($q) use ($today){
            return $q->whereYear('created_at', $today->format('Y'));
        }])->get();

        $list_type = \App\ReportType::select(['id', 'name'])->where('active', true)->get();
        //$report_every_month = \App\Report::groupBy(\DB::raw('MONTH(`created_at`)'))->get();
        //return dd($report_every_month);
        //return response()->json($report_every_month, 200, [], JSON_PRETTY_PRINT);
    	return view('admin.dashboard.index', [
    		'title' => 'Dashboard',
            'total_user' => $totalUsers,
            'total_clinic_today' => $totalClinicToday,
            'total_report_today' => $totalReportToday,
            'total_shifts_today' => $totalShifts,
            'report_current_year' => $report_current_year,
            'report_every_month' => $report_every_month,
            'list_type' => $list_type,
    	]);
    }
}
