<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $token =$user->createToken('auth_token')->plainTextToken;
        return $this->success(
            [
                'user'=>$user,
                'token'=>$token
            ],
                __('message.auth.register'),201);
        
    }
    public function login(LoginRequest $request)
    {
       

        if (auth()->attempt($request->only('email', 'password'))) {
            $user = auth()->user();
            $user->tokens()->delete(); 
            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->success(
                [
                    'user' => $user,
                    'token' => $token,
                ],
                __('message.auth.login'), 200
            );
        }

        return $this->error(__('message.auth.invalid_credentials'), 401); 
    }
    

}