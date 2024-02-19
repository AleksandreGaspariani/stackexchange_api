<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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
            return response()->json([
                'message' => 'Bad Creds'
            ], 400);
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

        $user->settings()->create([
            'user_id' => $user->id,
            'max_requests' => 10
        ]);

        $token = $user->createToken(config('auth.tokenName'))->plainTextToken;

        $response = [
            'user' => $user,
            'token' =>$token
        ];

        return response()->json($response);
    }

    public function logout()
    {
        Auth::user()->tokens()->where('token', request()->bearerToken())->delete();

        return response()->json([
            'message' => 'Logged Out'
        ]);
    }
}
