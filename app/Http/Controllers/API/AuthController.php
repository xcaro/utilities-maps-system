<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User as UserResource;
use App\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        //$credentials = $request->only(['email', 'password']);

        //return response()->json($this->credentials($request));
        $credentials = $this->credentials($request);
        
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['errors' => 'Unauthorized.'], 401);
        }
        //return $token;
        return $this->respondWithToken($token);
    }

    /**
     * Get the needed authorization credentials from the request.
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function credentials(Request $request)
    {
        $field = filter_var($request->get('username'), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        return array_merge([
            $field => $request->get('username'),
            'password' => $request->password,
        ], ['active' => true]);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return new UserResource(auth('api')->user());
        //return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function changeInfo(Request $request)
    {

        $user = User::find(auth('api')->user()->id);
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('username')) {
            $user->username = $request->username;
        }
        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }
        if ($request->has('address')) {
            $user->address = $request->address;
        }
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
}
