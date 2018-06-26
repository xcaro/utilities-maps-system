<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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

    // public function login(Request $request)
    // {
    //     $this->validateLogin($request);
    //     if ($this->hasTooManyLoginAttempts($request)) {
    //         $this->fireLockoutEvent($request);

    //         return $this->sendLockoutResponse($request);
    //     }
    //     if ($this->guard()->attempt($this->credentials($request), $request->filled('remember'))) {
    //         # code...
    //     }
    // }
	public function showLoginForm() 
	{
    	return view('admin.login');
    }

    public function username()
    {
        return 'username';
    }
    protected function credentials(Request $request)
    {
        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';
        return array_merge([
            $field => $request->get($this->username()),
            'password' => $request->password,
        ], ['active' => true]);
        // return array_merge([
        //     $field => $request->get($this->username()),
        //     'password' => $request->password,
        // ], ['active' => true]);
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ], [
            'password.required' => 'Mật khẩu là trường bắt buộc',
            $this->username() . '.required' => 'Tên người dùng là trường bắt buộc',
        ]);
    }
    // public function login(Request $request)
    // {
    //     if(Auth::guard('admTên)->attempt(['username' => $request->username, 'password' => $request->password])){
    //     	return redirect()->route('admin.dashboard');
    //     }
    //     return 'fail';
    // }
}
