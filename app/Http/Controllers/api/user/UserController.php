<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get_all(Request $request)
    {
        if(auth('api')->check()){
            $user = $request->user('api');
            $users = User::all()->toArray();
            return response()->json([
                'status' => true,
                'users' => $users,
            ],200);}
        return response()->json(['status'=>false,'message'=>'user didnt login'],200);
    }
}
