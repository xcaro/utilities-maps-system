<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Clinic as ClinicResource;
use App\Http\Resources\ClinicCollection;
use App\Clinic;
class ClinicController extends Controller
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
        // Lấy tất cả
        $result = Clinic::where([
            ['active', '=', true],
            ['confirmed', '=', true],
        ]);
        // Nếu có loại, lọc theo loại
        if (request('type')) {
            $result->where('type', request('type'));
        }
        // trả về
        return new ClinicCollection($result->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Clinic;
        $item->name = $request->name;
        $item->latitude = $request->latitude;
        $item->longitude = $request->longitude;
        $item->address = $request->address;
        $item->type = $request->type;
        $item->user_created = auth()->user()->id;
        if($item->save()){
            return response()->json([
                'message' => 'Created successful',
                'data' => new ClinicResource($item),
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
        return new ClinicResource(Clinic::findOrFail($id));
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
        $item = Clinic::find($id);
        $item->name = $request->name;
        $item->latitude = $request->latitude;
        $item->longitude = $request->longitude;
        $item->address = $request->address;
        $item->type = $request->type;
        $item->confirmed = $request->confirmed;
        if($item->save()){
            return response()->json([
                'message' => 'Updated successful',
                'data' => new ClinicResource($item),
            ], 201);
        }
        return response()->json([
            'message' => 'Data can not be processed',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Clinic::find($id);
        $item->active = false;
        $item->save();
        return response()->json(null, 204);
    }
}
