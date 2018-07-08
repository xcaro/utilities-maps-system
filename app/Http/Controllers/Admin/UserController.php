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
        $users = new User;
        if (request('status') !== null && request('status') !== '2') {
            $users = $users->where('active', \request('status') == '0' ? false:true);
        }
        if (request('q')) {
            $users = $users->where(function($query) {
                return $query->where('username', 'like', '%'.request('q').'%')
                       ->orWhere('name', 'like', '%'.request('q').'%');
            });
        }
        $users = $users->orderBy('created_at', 'desc')->paginate(10);
        //return $users;
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
        $user->active = true;
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
            \App\Clinic::where('user_created', $user->id)
                         ->update(['active' => false]);
                         
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
    public function changePassword($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.changepass', ['user' => $user]);
    }
    public function updatePassword(Request $request, $id)
    {
        $valid = \Validator::make($request->all(), [
            'oldPass' => 'required',
            'newPass' => 'required|min:6',
            'renewPass' => 'required|required_with:newPass|same:newPass|min:6'
        ])->validate();
        $old_pass = $request->oldPass;
        $new_pass = $request->newPass;
        $renew_pass = $request->renewPass;
        $user = User::findOrFail($id);
        if ($new_pass !== $renew_pass) {
            return redirect()
                   ->back()
                   ->withErrors('Mật khẩu nhập lại không trùng khớp');
        }
        if (\Hash::check($new_pass, $user->password)) {
            return redirect()
               ->back()
               ->withErrors('Mật khẩu mới trùng với mật khẩu cũ');
        }
        if (\Hash::check($old_pass, $user->password)) {
            $user->password = bcrypt($new_pass);
            if ($user->save()) {
                if (\Auth::user()->id == $id) {
                    \Auth::logout();
                }
                return redirect()
                       ->route('admin.user.index')
                       ->with('message', 'Đổi mật khẩu thành công');
            }
        }
        return redirect()
               ->back()
               ->withInput()
               ->withErrors('Mật khẩu cũ không đúng');

    }
}
