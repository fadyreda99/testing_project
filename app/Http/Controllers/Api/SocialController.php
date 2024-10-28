<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class SocialController extends Controller
{
    public function redirectToGoogle()
    {
        // Provide Google login URL for the frontend to use
        return response()->json(['url' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl()]);
    }

    public function handleGoogleCallback()
    {
        try {
            // Retrieve Google user details
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Find or create a user
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(uniqid()),
                    'social_id' => $googleUser->getId(),
                ]);
            }

            // Generate a JWT token using the 'api' guard
            $token = auth('api')->login($user);

            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60,
            ]);
        } catch (\Exception $e) {
            Log::channel('daily')->error('Google Authentication Failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to authenticate', 'details' => $e->getMessage()], 500);
        }
    }
}
