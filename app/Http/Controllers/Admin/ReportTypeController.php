<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ReportType;

class ReportTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listType = ReportType::where('active', true)->get();
        return view('admin.rtype.index', [
            'listType' => $listType,
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
        $item = new ReportType;
        $item->name = $request->name;
        $item->unconfirmed_icon = $request->unconfirmed_icon;
        $item->confirmed_icon = $request->confirmed_icon;
        $item->menu_icon = $request->menu_icon;
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
        return response()->json(ReportType::findOrFail($id));
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
        $item = ReportType::findOrFail($id);
        $item->name = $request->name;
        $item->unconfirmed_icon = $request->unconfirmed_icon;
        $item->confirmed_icon = $request->confirmed_icon;
        $item->menu_icon = $request->menu_icon;
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
        $item = ReportType::findOrFail($id);
        $item->active = false;
        if (!(\App\Report::where('type_id', $id)->exists()) && $item->save()) {
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
