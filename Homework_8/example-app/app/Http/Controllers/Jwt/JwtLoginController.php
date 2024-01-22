<?php

namespace App\Http\Controllers\Jwt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class JwtLoginController extends Controller
{

    public function me(Request $request) {
        return $request->user();
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        $credentials = $request->only('email','password');
        $token = Auth::guard('api')->attempt($credentials);
        if (!$token){
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ],401);
        }

        $user = Auth::guard('api')->user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ]);
    }

}
