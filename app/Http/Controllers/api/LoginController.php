<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function login(Request $request){

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $request->only('phone' , 'password');

        if(Auth::guard('api')->attempt($credentials)){
            $user =auth()->user();
            return [
                'status' => true,
                'message' =>'login successful',
                'token' => $user->createToken('create')->accessToken
            ];
        }
        $this->incrementLoginAttempts($request);
        return [
            'status' => false,
            'message' =>'login failed'
        ];
    }

    public function logout(Request $request){
        if(auth('api')->check()) {
            $request->user('api')->token()->revoke();
            return response()->json([
                'message' => 'Successfully logged out',
            ]);
        }
        return response()->json([
            'message' => 'you already log out',
        ]);

    }
}
