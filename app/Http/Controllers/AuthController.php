<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register()
    {
 
        $user=User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => bcrypt($user['password']),
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
}
