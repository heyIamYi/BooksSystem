<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;



class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function csrf()
    {
        return csrf_token();
    }

    public function login(Request $request)
    {
            $input = $request->all();
            $vallidation = Validator::make($input, [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($vallidation->fails()) {
                return response()->json(['error' => $vallidation->errors()], 422);
            }

            if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
                $user  = Auth::user();
                $token = $user->createToken('UserToken')->accessToken;

                return response()->json(['token' => $token]);
            }
    }
}
