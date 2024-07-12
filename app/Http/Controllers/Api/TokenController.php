<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;

class TokenController extends Controller
{
    public function createToken(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $user = User::where('email', $credentials["email"])->first();
        if (! $user || ! Hash::check($credentials["password"], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    
        $token = $user->createToken('remember_token')->plainTextToken;
       
        // $rememberToken = Str::random(60);
        $user->setRememberToken($token);
        $user->save();
    
        return response()->json(['token' => $token]);
    }
}