<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getResetToken(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
        $user = \App\User::where('email', $request->input('email'))->first();
        if (!$user) {
            return response()->json(['error' => trans('passwords.user')], 400);
        }
        $token = $this->broker()->createToken($user);
        $user->sendPasswordResetNotification($token);
        return response()->json(['token' => $token]);
    }
}
