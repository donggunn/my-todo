<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function login()
    {
        if (Auth::attempt(['email'=>request('email'), 'password' =>request('password')])) {
            $user = Auth::user();
            $success['name'] = $user->name;
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['success'=>$success], 200);
        } else {
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function register()
    {
        
    }
}
