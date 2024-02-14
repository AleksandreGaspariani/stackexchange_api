<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class LoginController extends Controller
{
    public function login(Request $request){

        $creds = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if (Auth::attempt($creds)){

            $token = Auth::user()->createToken('AccessToken')->accessToken;

            return [
                'message' => 'success login',
                'data'=> Auth::user(),
                'token' => $token['token']
            ];

        }else {
            return 'Wrong Credentials';
        }
    }

    public function logout()
    {

    }
}
