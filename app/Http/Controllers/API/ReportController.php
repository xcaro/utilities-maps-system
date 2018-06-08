<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\Report as ReportResource;
use App\Http\Resources\ReportCollection;
use App\Report;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->authorize('view-report');
        return new ReportCollection(Report::paginate(1000));
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
        $report->comment = $request->comment;
        $report->type_id = $request->type;
        $report->user_created = auth()->user()->id;
        if($report->save())
        {
            return response()->json([
                'status' => 'Created successful',
                'data' => $report,
            ], 201);
        }
        return response()->json([
            'status' => 'Data can not be processed',
        ], 201);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ReportResource(Report::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $report = Report::find($id);
        $report->latitude = $request->latitude;
        $report->longitude = $request->longitude;
        $report->comment = $request->comment;
        $report->type_id = $request->type;
        $report->user_created = auth()->user()->id;
        $report->confirm = $request->confirm;
        $report->image = $request->image;
        $report->save();
        
        return response()->json([
            'status' => 'Updated successful',
            'data' => $report,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = Report::find($id);
        $report->active = false;
        $report->save();
        return response()->json(null, 204);
    }

    public function confirm(Report $report)
    {
        $report->confirm = true;
        $report->save();
        return response()->json(null, 204);
    }
    public function unconfirm(Report $report)
    {
        $report->confirm = false;
        $report->save();
        return response()->json(null, 204);
    }
}
