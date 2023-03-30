<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (auth()->attempt($credentials)) {
            $token = $request->user()->createToken('MyAppToken')->accessToken;

            // dd($token->token);

            return ['token' => $token->token];
        }

        return response()->json(['error' => 'Unauthenticated'], 401);
    }
}
