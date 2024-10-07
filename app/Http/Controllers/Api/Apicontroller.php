<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Apicontroller extends Controller
{
    //

    public function register(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "email" => "required|string|email|unique:users",
            "password" => "required|confirmed",
        ]);

        User::create([
"name"=> $request->name,
"email"=> $request->email,
"password"=> bcrypt($request->password),
        ]);

        return response()->json([
            "status"=>true,
            "message" => "User register successfully",
            "data"=> []
        ]);
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Credentials!',
                'errors' => $validator->errors()->all(),
            ], 401);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->accessToken;
            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully.',
                'user' => $user,
                'token' => $token,
                'token_type' => 'bearer',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Credentials!',
            ], 401);
        }
    }




    public function profile() {}
    public function logout() {}
}
