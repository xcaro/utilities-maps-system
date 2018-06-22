<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserTurn as UserTurnResource;
use App\Http\Resources\UserTurnCollection;
use App\UserTurn;

class UserTurnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return new UserTurnCollection(UserTurn::where('user_id', $id)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
       vềshift_id = $request->shift_id;

        $turn = new UserTurn;
        $turn->user_id = auth()->user()->id;
        $turn->register_day = $turn->register_day;

        if ($turn->save()) {
            $turn->shifts()->attach($shift_id);
            return response()->json([
                'message' => 'Created successful',
                'data' => new UserTurnResource($turn),
            ], 201);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id, $id)
    {
        return new UserTurnResource(UserTurn::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id, $id)
    {
        $confirm_shift_id = $request->confirm_shift_id;
        $turn = UserTurn::findOrFail($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $id)
    {
        //
    }
}
