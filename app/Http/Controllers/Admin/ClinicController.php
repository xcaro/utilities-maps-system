<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Clinic;
use App\ClinicType;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listType = ClinicType::where('active', true)->get();
        $listClinic = Clinic::where('active', true)->get();
        return view('admin.clinic.index', [
            'listClinic' => $listClinic,
            'listType' => $listType,
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
        return view('admin.clinic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
    public function filter(Request $request)
    {
        $cln = Clinic::where('active', true);
        if ($request->has('type') && $request->type != 0) {
            $cln->where('type', $request->type);
        }
        if ($request->has('district') && ($request->district != 0)) {
            $cln->where('district_id', $request->district);
        }
        if ($request->has('status') && ($request->status == 0 || $request->status == 1)) {
            $cln->where('confirm', $request->status == 0 ? false:true);
        }
        return response()->json($cln->get());
    }
}
