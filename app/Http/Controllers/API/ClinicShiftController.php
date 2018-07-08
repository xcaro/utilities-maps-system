<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClinicShift as ClinicShiftResource;
use App\Http\Resources\ClinicShiftCollection;
use App\ClinicShift;
use Illuminate\Support\Carbon;

class ClinicShiftController extends Controller
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
    public function index($id)
    {
        return new ClinicShiftCollection(ClinicShift::where([
            ['clinic_id', '=', $id],
            ['active', '=', true],
        ])->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $item = new ClinicShift;
        $item->name = $request->name;
        $item->clinic_id = $id;
        $item->start_shift = Carbon::createFromFormat('Y-m-d H:i:s',$request->start_shift);
        $item->end_shift = Carbon::createFromFormat('Y-m-d H:i:s',$request->end_shift);

        if ($item->save()) {
            return response()->json([
                'message' => 'Created successful',
                'data' => new ClinicShiftResource($item),
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
    public function show($clinic_id, $id)
    {
        return new ClinicShiftResource(ClinicShift::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $clinic_id, $id)
    {
        $item = ClinicShift::findOrFail($id);
        $item->name = $request->name;
        $item->clinic_id = $id;
        $item->start_shift = Carbon::createFromFormat('Y-m-d H:i:s',$request->start_shift);
        $item->end_shift = Carbon::createFromFormat('Y-m-d H:i:s',$request->end_shift);

        if ($item->save()) {
            return response()->json([
                'message' => 'Created successful',
                'data' => new ClinicShiftResource($item),
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
    public function destroy($clinic_id, $id)
    {
        $item = ClinicShift::findOrFail($id);
        $item->active = false;
        $item->save();
        return response()->json(null, 204);
    }
    public function multiShifts($id, Request $request)
    {
        $shifts = $request->shifts;
        $total = 0;
        \DB::beginTransaction();
        foreach ($shifts as $shift) {
            $item = new ClinicShift;
            $item->name = $shift['name'];
            $item->clinic_id = $id;
            $item->start_shift = Carbon::createFromFormat('Y-m-d H:i:s',$shift['start_shift']);
            $item->end_shift = Carbon::createFromFormat('Y-m-d H:i:s',$shift['end_shift']);
            if ($item->save()) {
                $total++;
            }
        }
        if (count($shifts) === $total) {
            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Tạo ca thành công',
            ], 200);
        }
        else {
            \DB::rollBack();
        }
        return response()->json([
            'success' => false,
            'message' => 'Tạo ca không thành công',
        ], 200);
    }
    
}
