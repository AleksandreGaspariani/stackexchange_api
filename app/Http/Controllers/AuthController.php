<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){

        $creds = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if (Auth::attempt($creds)){

            $token = Auth::user()->createToken('myToken')->plainTextToken;

            $response = [
                'user' => Auth::user(),
                'token' => $token
            ];

            return response($response, 200);

        }else {
            return response([
                'message' => 'Bad Creds'
            ], 401);
        }
    }

    public function register(Request $request){

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        $token = $user->createToken('myToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' =>$token
        ];

        return response($response,201);
    }

    public function logout(Request $request)
    {
        auth('sanctum')->user()->tokens()->delete();

        return response([
            'message' => 'Logged Out'
        ], 200);
    }
}
