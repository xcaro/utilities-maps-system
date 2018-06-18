<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\Report as ReportResource;
use App\Http\Resources\ReportCollection;
use App\Report;
use r;
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
        //$this->authorize('view-report');
        return (new ReportCollection(Report::paginate(1000)))
                ->response()
                ->setStatusCode(206);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            //rql 
            $r_result = r\db(env('R_DATABASE'))->table('activeReports')
                ->insert([
                    'id' => $report->id,
                    'latitude' => $report->latitude,
                    'longitude' => $report->longitude,
                    'comment' => $report->comment,
                    'type_id' => $report->type_id,
                    'confirm' => false,
                    'created_at' => $report->created_at,
                    'updated_at' => $report->updated_at,
                ])
                ->run($r_connect);
            $r_connect->close();
            //response
            return response()->json([
                'message' => 'Created successful',
                'data' => $report,
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
        return (new ReportResource(Report::findOrFail($id)))
                ->response()
                ->setStatusCode(200);
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
            'message' => 'Updated successful',
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
        //rql
        $r_connect = r\connect('localhost');
        $result = r\db('app')->table('activeReports')->get((int)$id)->delete()->run($r_connect);
        $r_connect->close();

        $report = Report::find($id);
        $report->active = false;
        $report->save();
        return response()->json(null, 204);
    }

    public function confirm(Report $report)
    {
        $r_connect = r\connect('localhost');
        $result = r\db('app')->table('activeReports')->get((int)$report->id)->update(['confirm' => true])->run($r_connect);
        $r_connect->close();

        $report->confirm = true;
        $report->save();
        return response()->setStatusCode(204);
    }
    public function unconfirm(Report $report)
    {
        $r_connect = r\connect('localhost');
        $result = r\db('app')->table('activeReports')->get((int)$report->id)->update(['confirm' => false])->run($r_connect);
        $r_connect->close();

        $report->confirm = false;
        $report->save();
        return response()->setStatusCode(204);
    }
}
