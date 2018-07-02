<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    public function city()
    {
    	return \App\City::all()->makeHidden(['created_at', 'updated_at']);
    }
    public function district()
    {
    	if (request('city_id')) {
    		return response()->json([
	    		'data' => \App\District::where('city_id', request('city_id'))->get()->makeHidden(['created_at', 'updated_at']),
	    	]);
    	}
    	return response()->json([
    		'data' => \App\District::all()->makeHidden(['created_at', 'updated_at'])
    	]);
    }
    public function ward($district_id)
    {
    	return response()->json([
    		'data' => \App\Ward::where('district_id', $district_id)->get()->makeHidden(['created_at', 'updated_at']),
    	]);
    }
}
