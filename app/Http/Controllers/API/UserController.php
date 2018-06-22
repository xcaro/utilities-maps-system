<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use App\Http\Resources\User as UserResource;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|between:6,64',
            'username' => 'required|string|between:3,64|unique:users,username',
            'phone' => 'required|regex:/[0-9]{10}/',
            'address' => 'max:255',
        ]);

        if ($valid->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $valid->errors(),
            ], 422);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->address = $request->address;
        if ($user->save()) {
            return response()->json([
                'success' => true,
                'messages' => 'Đăng ký tài khoản thành công',
                'data' => new UserResource($user),
            ], 201);
        }
        return response()->json([
            'success' => false,
            'messages' => 'Đăng ký tài khoản không thành công.',
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
        return new UserResource(User::findOrFail($id));
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
}
