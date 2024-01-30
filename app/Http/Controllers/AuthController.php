<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Add your login logic here
        // For simplicity, let's assume the user logs in with a valid email and password
        // if ($request->email === 'user@example.com' && $request->password === 'password') {
        //     return response()->json(['message' => 'Login successful']);
        // } else {
        //     return response()->json(['message' => 'Invalid credentials'], 401);
        // }
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $token = auth()->user()->createToken('authToken')->plainTextToken;
            return response()->json(['token' => $token], 200);
        }
        
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
