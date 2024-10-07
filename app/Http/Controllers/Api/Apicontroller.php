<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
    public function login() {}
    public function profile() {}
    public function logout() {}
}
