<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;


class AuthApiController extends Controller
{
    public function login(): JsonResponse
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', request()->email)->first();

        if(!$user->isActive()) {
            return response()->json(['message' => 'Your account is not active. Please contact the administrator.'],Response::HTTP_UNAUTHORIZED );
        }

        if (! $user || ! Hash::check(request()->password, $user->password)) {
            return response()->json(['message' => 'The provided credentials are incorrect.'],Response::HTTP_UNAUTHORIZED );
           
        }

        return response()->json([
            'token' => $user->createToken("auth_token")->plainTextToken
        ]);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }
}
