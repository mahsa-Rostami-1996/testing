<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    //
    public function signup(Request $request)
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $userCheck = User::where('email', '=', $request['email'])
        ->first();
        if($userCheck == null){
            $user->create($request); 
            return $user->createToken('token_name', ['user:view']);   
        }
        else{
            dd("invalid email");
        }
    }
    public function login(Request $request)
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', '=', $request['email'])
        ->where('password', '=', md5($request['password']))
        ->first();
        return $user->createToken('token_name', ['user:view']);
    }
}
