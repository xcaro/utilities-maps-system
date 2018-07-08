<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ClinicType;

class ClinicTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listType = \App\ClinicType::where('active', true)->get();
        return view('admin.ctype.index', [
            'list_type' => $listType
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = \Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);
        $item = new ClinicType;
        $item->name = $request->name;
        if ($item->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Thêm loại mới thành công',
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Thêm loại mới thất bại',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = ClinicType::findOrFail($id);
        return response()->json($type);
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
        $valid = \Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ])->validate();
        $item = ClinicType::findOrFail($id);
        $item->name = $request->name;
        if ($item->save()) {
            return response()->json([
                'message' => 'Cập nhật loại thành công',
                'success' => true,
            ]);
        }
        return response()->json([
            'message' => 'Cập nhật loại thất bại',
            'success' => false,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ClinicType::findOrFail($id);
        $item->active = false;
        if (!(\App\Clinic::where('type', $id)->where('active', true)->exists()) && $item->save()) {
            return response()->json([
                'message' => 'Xoá thành công',
                'success' => true,
            ]);
        }
        return response()->json([
            'message' => 'Xoá thất bại',
            'success' => false,
        ]);
    }
}
