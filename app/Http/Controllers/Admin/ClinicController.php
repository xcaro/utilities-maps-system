<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Clinic;
use App\ClinicType;
use r;
use Illuminate\Support\Carbon;

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
        $listType = ClinicType::where('active', true)->get();
        return view('admin.clinic.create', [
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
        $cln = Clinic::find($id);
        $listType = ClinicType::where('active', true)->get();
        return view('admin.clinic.edit', [
            'listType' => $listType,
            'cln' => $cln,
        ]);
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
        $item->address = $request->address;
        $item->latitude = $request->latitude;
        $item->longitude = $request->longitude;
        $item->description = $request->description;
        $item->end_date = Carbon::createFromFormat('Y-m-d', $request->end_date);
        $item->active = $request->active == 'on' ? true:false;
        if ($item->save()) {
            $item = Clinic::find($id);
            $r_connect = r\connect(env('R_HOST'), env('R_PORT'));
            $r_result = r\db(env('R_DATABASE'))->table('activeClinics')
                ->get((int)$id)->update($item->toArray())
                ->run($r_connect);
            $r_connect->close();

            return redirect()->route('admin.clinic.index')->with('message', 'Chỉnh sửa thành công');
        }
        return redirect()->route('admin.clinic.index')->withErrors('Chỉnh sửa không thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $r_connect = r\connect(env('R_HOST'), env('R_PORT'));
        $result = r\db('app')->table('activeClinics')->get((int)$id)->delete()->run($r_connect);
        $r_connect->close();
        
        Clinic::find($id)->update(['active' => false]);
        return response()->json([
            'success' => true,
            'message' => 'Deleted',
        ], 200);
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
            $cln->where('confirmed', $request->status == 0 ? false:true);
        }
        return response()->json([
            'results' => $cln->get(),
            'total_results' => $cln->count(),
        ]);
    }
    public function confirm($id)
    {
        $r_connect = r\connect(env('R_HOST'), env('R_PORT'));
        $result = r\db('app')->table('activeClinics')->get((int)$id)->update(['confirmed' => true])->run($r_connect);
        $r_connect->close();

        Clinic::find($id)->update(['confirmed' => true]);
        return response()->json([
            'success' => true,
            'message' => 'Confirmed',
        ], 200);
    }
    public function unconfirm($id)
    {
        $r_connect = r\connect(env('R_HOST'), env('R_PORT'));
        $result = r\db('app')->table('activeClinics')->get((int)$id)->update(['confirmed' => false])->run($r_connect);
        $r_connect->close();
        
        Clinic::find($id)->update(['confirmed' => false]);
        return response()->json([
            'success' => true,
            'message' => 'Unconfirmed',
        ], 200);
    }
}
