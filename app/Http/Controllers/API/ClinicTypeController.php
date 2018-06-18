<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ClinicType;
use App\Http\Resources\ClinicType as ClinicTypeResource;
use App\Http\Resources\ClinicTypeCollection;

class ClinicTypeController extends Controller
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
        return new ClinicTypeCollection(ClinicType::where('active', true)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new ClinicType;
        $item->name = $request->name;
        if ($item->save()) {
            return response()->json([
                'message' => 'Created successful',
                'data' => $item,
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
        return new ClinicTypeResource(ClinicType::findOrFail($id));
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
        $item = ClinicType::find($id);
        $item->name = $request->name;
        if ($item->save()) {
            return response()->json([
                'message' => 'Updated successful',
                'data' => $item,
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
        $type = ClinicType::find($id);
        $type->active = false;
        $type->save();
        return response()->json([], 204);
    }
}
