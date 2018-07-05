<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;

use App\Http\Resources\Report as ReportResource;
use App\Http\Resources\ReportCollection;
use App\Report;
use r;
use Auth;
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show', 'store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Auth::guard('api')->user();
        //$this->authorize('report-control');
        return (new ReportCollection(Report::paginate(1000)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportRequest $request)
    {
        // rql
        $r_connect = r\connect(env('R_HOST'), env('R_PORT'));

        //mysql
        $report = new Report;
        $report->latitude = $request->latitude;
        $report->longitude = $request->longitude;
        $report->comment = $request->comment;
        $report->type_id = $request->type;
        $report->user_created = auth('api')->check()? auth('api')->user()->id:null;

        if($report->save())
        {
            $report = Report::find($report->id);
            if($request->hasFile('image')) 
            {
                $file = $request->image;
                $ext = $file->getClientOriginalExtension();
                $name = $report->id . '.' . $ext;
                $file->move(public_path('upload/reports'), $name);
                
                $report->image = $name;
                $report->save();
            }

            $r_result = r\db(env('R_DATABASE'))->table('activeReports')
                ->insert($report->toArray())
                ->run($r_connect);
            $r_connect->close();
            //response
            return response()->json([
                'message' => 'Created successful',
                'data' => new ReportResource($report),
            ], 201);
        }
        return response()->json([
            'message' => 'Data can not be processed',
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
        return (new ReportResource(Report::findOrFail($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReportRequest $request, $id)
    {
        $report = Report::find($id);
        $report->latitude = $request->latitude;
        $report->longitude = $request->longitude;
        $report->comment = $request->comment;
        $report->type_id = $request->type;
        $report->confirm = $request->confirm;
        $report->image = $request->image;
        $report->save();
        
        return response()->json([
            'message' => 'Updated successful',
            'data' => new ReportResource($report),
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
        //rql
        $r_connect = r\connect(env('R_HOST'), env('R_PORT'));
        $result = r\db('app')->table('activeReports')->get((int)$id)->delete()->run($r_connect);
        $r_connect->close();

        $report = Report::find($id);
        $report->active = false;
        $report->save();
        return response()->json(null, 204);
    }

    public function confirm(Report $report)
    {
        $r_connect = r\connect(env('R_HOST'), env('R_PORT'));
        $result = r\db('app')->table('activeReports')->get((int)$report->id)->update(['confirm' => true])->run($r_connect);
        $r_connect->close();

        $report->confirm = true;
        $report->save();
        return response()->json(null, 204);
    }
    public function unconfirm(Report $report)
    {
        $r_connect = r\connect(env('R_HOST'), env('R_PORT'));
        $result = r\db('app')->table('activeReports')->get((int)$report->id)->update(['confirm' => false])->run($r_connect);
        $r_connect->close();

        $report->confirm = false;
        $report->save();
        return response()->json(null, 204);
    }
}
