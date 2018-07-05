<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;

class SettingController extends Controller
{
    public function index()
    {
    	$default_clinic_expire = Setting::where('key', 'default_clinic_expire')->first();
    	return view('admin.setting.index', [
    		'default_clinic_expire' => $default_clinic_expire,
    	]);
    }
    public function update(Request $request)
    {
    	$r = \Validator::make($request->all(), [
    		'default_clinic_expire' => 'required|numeric'
    	])->validate();
    	$default_clinic_expire = $request->default_clinic_expire;
    	$item = Setting::where('key', 'default_clinic_expire')->first();
    	$item->value = $default_clinic_expire;
    	if ($item->save()) {
    		return redirect()
    			   ->route('admin.setting.index')
    			   ->with('message', 'Chỉnh sửa cài đặt thành công');
    	}
    	return redirect()
			   ->route('admin.setting.index')
			   ->withErrors('Chỉnh sửa không thành công');
    }
}
