<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	use AuthenticatesUsers;

	protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

 //    protected function guard()
	// {
	//     return Auth::guard('auth');
	// }

	public function showLoginForm() 
	{
    	return view('admin.login');
    }

    public function username()
    {
        return 'username';
    }


    
    // public function login(Request $request)
    // {
    //     if(Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])){
    //     	return redirect()->route('admin.dashboard');
    //     }
    //     return 'fail';
    // }
}
