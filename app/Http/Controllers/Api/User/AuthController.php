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
use Twilio\Rest\Client;

class AuthController extends Controller
{
    public function login(LoginRequest $request){

        // dd($request->phone);
        $user = User::where('phone', $request->phone)->first();

        // dd($user->phone, $request->phone);

        // if (!$user || !Hash::check($request->password, $user->password)) {
        //     throw ValidationException::withMessages([
        //         'phone' => ['The provided credentials are incorrect.'],
        //     ]);
        // }

        // dd($user->password, $request->password);

        if(Hash::check($request->password, $user->password)){
            return $this->generateToken($user);
        }else{
            throw ValidationException::withMessages([
                'password' => 'The provided credentials are incorrect.',
            ]);

        };

    }

    public function register(RegisterRequest $request){

        // dd($request->validated());
        $user = User::create($request->validated());

            $sid = getenv("TWILIO_ACCOUNT_SID");
            $token = getenv("TWILIO_AUTH_TOKEN");
            $verificationSid = getenv("TWILIO_VERIFICATION_SID");
            $twilio = new Client($sid, $token);

            $verification = $twilio->verify->v2->services($verificationSid)
            ->verifications
            ->create("+88" . $user->phone, "sms");

        print($verification->status);
        return response()->json($verification->status);

        // return $this->generateToken($user);
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
