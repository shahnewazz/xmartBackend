<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\User\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\LoginRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request){
        
        $user = User::where('phone', $request->phone)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'phone' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        return $this->generateToken($user);
    }

    public function register(RegisterRequest $request){

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return $this->generateToken($user);
    }

    public function generateToken($user){
        $token = $user->createToken('user-token')->plainTextToken;

        return (new AuthResource($user))
                ->additional(['meta' => [
                    'token' => $token,
                    'token_type' => 'bearer',
                ]]);
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();

        return send_msg("Logged Out", true, 200);
    }

    public function user(Request $request){
        return AuthResource::make($request->user());
    }
}
