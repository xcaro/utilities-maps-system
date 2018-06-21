<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SocialAccountService;
use Illuminate\Support\Facades\Log;
use Socialite;
use App\User;
class AuthController extends Controller
{
    public function login(Request $request)
    {
    	
    }
    public function logout()
    {
    	return redirect()->route('home');
    }
    public function redirect()
    {
    	return Socialite::driver('google')->redirect();
    }
    public function callback()
    {
        $appUser = Socialite::driver('google')->user();
        return dd($appUser);
        $user = User::where('email', $appUser->email)->first();
        if ($user) {
        	auth()->login($user);
        	return redirect()->intended('/');
        }
        return view('register', ['user' => $appUser]);
        //return redirect()->to('/home');
    }
    public function signup()
    {
    	return view('register');
    }
    public function register()
    {
    	# code...
    }
}
