<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Apicontroller;

// Open Route

Route::post("register", [Apicontroller::class,"register"]);
Route::post("login", [Apicontroller::class,"login"]);

// protected Route

Route::group([
    "middleware" => ["auth.api"]
], function(){
    Route::get("profile", [Apicontroller::class,"profile"]);
    Route::get("logout", [Apicontroller::class,"logout"]);
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');
