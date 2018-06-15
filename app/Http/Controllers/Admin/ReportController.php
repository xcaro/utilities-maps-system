<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Report;
class ReportController extends Controller
{
    public function __construct()
    {
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
        Report::find($id)->update(['active' => 0]);
        return response()->json(null, 204);
    }
    public function confirm($id)
    {
        Report::find($id)->update(['confirm' => 1]);
        return response()->json([
            'message' => 'Confirmed',
        ], 200);
    }
}
