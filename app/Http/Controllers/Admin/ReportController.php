<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Report;
use r;
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$this->authorize('view-report');
        $listRp = Report::select(['id','latitude', 'longitude','confirm', 'type_id', 'comment'])->where('active', true)->get();
        return view('admin.report.index', [
            'title' => 'List Reports',
            'listReport' => $listRp,
            'listType' => \App\ReportType::where('active', 1)->get(),
            'listDistrict' => \App\District::where('city_id', 1)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listType = \App\ReportType::where('active', 1)->get();
        return view('admin.report.create', [
             'title' => 'Add Reports',
             'listType' => $listType,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $report = new Report;
        $report->latitude = $request->latitude;
        $report->longitude = $request->longitude;
        $report->notes = $request->notes;
        $report->type_id = $request->type;
        $report->user_created = auth()->user()->id;
        $report->save();
        return redirect()->route('admin.reports.index')->with(['message' => 'Thêm thành công!', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $listType = \App\ReportType::where('active', 1)->get();
        return view('admin.report.edit', [
            'title' => 'Edit Reports',
            'report' => Report::find($id),
            'listType' => $listType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        return response()->json($report);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $r_connect = r\connect(env('R_HOST'), env('R_PORT'));
        $result = r\db('app')->table('activeReports')->get((int)$id)->delete()->run($r_connect);
        $r_connect->close();

        Report::find($id)->update(['active' => false]);
        return response()->json([
            'success' => true,
            'message' => 'Deleted',
        ], 200);
    }
    public function confirm($id)
    {

        $r_connect = r\connect(env('R_HOST'), env('R_PORT'));
        $result = r\db('app')->table('activeReports')->get((int)$id)->update(['confirm' => true])->run($r_connect);
        $r_connect->close();

        Report::find($id)->update(['confirm' => true]);
        return response()->json([
            'success' => true,
            'message' => 'Confirmed',
        ], 200);
    }
    public function unconfirm($id)
    {

        $r_connect = r\connect(env('R_HOST'), env('R_PORT'));
        $result = r\db('app')->table('activeReports')->get((int)$id)->update(['confirm' => false])->run($r_connect);
        $r_connect->close();
        
        Report::find($id)->update(['confirm' => false]);
        return response()->json([
            'success' => true,
            'message' => 'Unconfirmed',
        ], 200);
    }
    public function filter(Request $request)
    {
        //$req = [];
        $reports = Report::where('active', true);
        if ($request->has('type') && $request->type != 0) {
            //$req[] = ['type_id', '=', $request->type];
            $reports->where('type_id', $request->type);
        }
        if ($request->has('status') && ($request->status == 0 || $request->status == 1)) {
            //$req[] = ['confirm', '=', $request->status == 0 ? false : true];
            $reports->where('confirm', $request->status == 0 ? false : true);
        }
        if ($request->has('district') && $request->district != 0) {
            //$req[] = ['district', '=', $request->district];
            $reports->where('district_id', $request->district);
        }
        //$req[] = ['active', '=', true];
        //$reports = Report::where($req)->get();
        // return response()->json($reports->get());
        return response()->json([
            'results' => $reports->get(),
            'total_results' => $reports->count(),
        ]);
    }
}
