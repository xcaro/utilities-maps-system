<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ReportType;
use App\Http\Resources\ReportType as ReportTypeResource;
use App\Http\Resources\ReportTypeCollection;
use Auth;
class ReportTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ReportTypeCollection(ReportType::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new ReportType;
        $item->name = $request->name;
        if ($item->save()) {
            return response()->json(['message' => 'Created successful']);
        }
        return response()->json(['message' => 'Data cannot access']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ReportTypeResource(ReportType::findOrFail($id));
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
        $item = ReportType::find($id);
        $item->name = $request->name;
        if ($item->save()) {
            return response()->json(['message' => 'Created successful']);
        }
        return response()->json(['message' => 'Data cannot access']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
