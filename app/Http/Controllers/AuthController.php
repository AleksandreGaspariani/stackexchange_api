<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {

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
                'message' => 'Bad creds'
            ], 400);
        }
    }

    public function register(RegisterRequest $request): JsonResponse
    {

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);

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

    public function logout(): JsonResponse
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged Out'
        ]);
    }
}
