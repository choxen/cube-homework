<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\IsPasswordCorrect;
use App\Rules\UserExists;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ]);

        $token = $user->createToken('user_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $user = User::where('email', $request->get('email'))->first();

        $request->validate([
            'email' => [
                'required',
                'string',
                new UserExists($user),
            ],
            'password' => [
                'required',
                'string',
                new IsPasswordCorrect($user)
            ]
        ]);

        $token = $user->createToken('user_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }
}
