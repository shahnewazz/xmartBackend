<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Resources\Seller\SellerAuthResource;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Seller\SellerLoginRequest;

class SellerAuthController extends Controller
{
    public function login(SellerLoginRequest $request){
        
        $seller = Seller::where('phone', $request->phone)->first();
 
        if (! $seller || ! Hash::check($request->password, $seller->password)) {
            throw ValidationException::withMessages([
                'phone' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        return $this->generateToken($seller);
    }

    public function generateToken($seller){
        $token = $seller->createToken('seller-token')->plainTextToken;

        return (new SellerAuthResource($seller))
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
        return SellerAuthResource::make($request->user());
    }
}
