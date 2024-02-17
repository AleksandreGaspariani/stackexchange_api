<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\alert;


class AuthController extends Controller
{
    public function login(LoginRequest $request){

        $creds = $request->validated();

        if (Auth::attempt($creds)){

            $token = Auth::user()->createToken(config('auth.tokenName'))->plainTextToken;

            $response = [
                'user' => Auth::user(),
                'token' => $token
            ];

            return response()->json($response);

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

//      Creating setting for registered user
        UserSettings::create([
            'user_id' => $user->id,
            'max_requests' => 10,
            'requests_sent' => 0
        ]);

        $token = $user->createToken('myToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' =>$token
        ];

        return response($response,201);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response([
            'message' => 'Logged Out'
        ], 200);
    }
}
