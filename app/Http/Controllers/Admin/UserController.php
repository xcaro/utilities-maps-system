<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.user.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = \App\Role::all();
        
        return view('admin.user.create', [
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->role_id = $request->role;
        $user->active = $request->active === 'on' ? true:false;
        if ($user->save()) {
            return redirect()
                   ->route('admin.user.index')
                   ->with('message', 'Tạo tài khoản thành công');
        }
        return redirect()
               ->back()
               ->withInput($request->except("password"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.user.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = \App\Role::all();
        return view('admin.user.edit', [
            'roles' => $roles,
            'user' => $user,
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
        $valid = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'string|between:6,64',
            'username' => 'required|string|between:3,64',
            'phone' => 'required|regex:/[0-9]{10}/',
            'address' => 'max:255',
        ])->validate();

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        if ($request->password != '') {
            $user->password = bcrypt($request->password);
        }
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->role_id = $request->role;
        $user->active = $request->active === 'on' ? true:false;
        if ($user->save()) {
            return redirect()
                   ->route('admin.user.index')
                   ->with('message', 'Cập nhật tài khoản thành công');
        }
        return redirect()
               ->back()
               ->withInput($request->except("password"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->active = false;
        if ($user->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Đã xoá thành công',
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Không thể xoá',
        ], 200);
    }

    public function search()
    {
        $users = User::select(['id', 'username'])->where('active', true)->where('username', 'like', '%'.\request('username').'%')->get();
        return response()->json($users, 200, [], JSON_PRETTY_PRINT);
    }
}
