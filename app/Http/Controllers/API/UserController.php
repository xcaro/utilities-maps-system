<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use App\Http\Resources\User as UserResource;
use Hash;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['store']]);
    }
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
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if ($user->save()) {
            return response()->json([
                'success' => true,
                'messages' => 'Cập nhật tài khoản thành công',
                'data' => new UserResource($user),
            ], 201);
        }
        return response()->json([
            'success' => false,
            'messages' => 'Cập nhật tài khoản không thành công',
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
        //
    }

    public function changePassword(Request $request)
    {
        $current_password = $request->current_password;
        $new_password = $request->new_password;
        $renew_password = $request->renew_password;

        if (Hash::check($current_password, auth('api')->user()->password)) {
            if ($new_password === $renew_password) {
                $user = auth('api')->user();
                $user->password = bcrypt($renew_password);
                
                if ($user->save()) {
                    auth('api')->logout();
                    return response()->json([
                        'success' => true,
                        'message' => 'Đổi mật khẩu thành công, tài khoản đã đăng xuất',
                    ], 200);
                }
                
            }
        }
        return response()->json([
            'success' => false,
            'message' => 'Đổi mật khẩu không thành công',
        ], 200);
    }
}
