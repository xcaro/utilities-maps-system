<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\ReportTypeRequest;
use App\Http\Controllers\Controller;

use App\ReportType;
use App\Http\Resources\ReportType as ReportTypeResource;
use App\Http\Resources\ReportTypeCollection;

use Auth;
class ReportTypeController extends Controller
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
        return new ReportTypeCollection(ReportType::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportTypeRequest $request)
    {
        $res = $request->validated();
        //return response()->json($res);
        $item = new ReportType;
        $item->name = $request->name;
        $item->confirmed_icon = $request->confirmed_icon;
        $item->unconfirmed_icon = $request->unconfirmed_icon;
        $item->menu_icon = $request->menu_icon;
        $item->alive = $request->alive;
        if ($item->save()) {
            return response()->json([
                'message' => 'Created successful',
                'data' => new ReportTypeResource($item),
            ]);
        }
        return response()->json(['message' => 'Data cannot access'], 200);
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
    public function update(ReportTypeRequest $request, $id)
    {
        $item = ReportType::find($id);
        $item->name = $request->name;
        $item->confirmed_icon = $request->confirmed_icon;
        $item->unconfirmed_icon = $request->unconfirmed_icon;
        $item->menu_icon = $request->menu_icon;
        if ($item->save()) {
            return response()->json([
                'message' => 'Updated successful',
                'data' => new ReportTypeResource($item),
            ]);
        }
        return response()->json(['message' => 'Data cannot access'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = ReportType::find($id);
        $type->active = false;
        $type->save();
        return response()->json([], 204);
    }
}
