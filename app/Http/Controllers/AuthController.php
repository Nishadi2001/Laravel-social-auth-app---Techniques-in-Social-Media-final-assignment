<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthController extends Controller
{
    // Redirect to Google for login
    public function redirectToGoogle()
    {
      return Socialite::driver('google')->redirect();
  
    }

    // Handle Google callback
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        if (!$googleUser->getEmail()) {
                return redirect('/')->with('error', 'No email returned from Google.');
                \Log::info('Google User Data', [
    'id' => $googleUser->getId(),
    'email' => $googleUser->getEmail(),
    'name' => $googleUser->getName(),
    'avatar' => $googleUser->getAvatar(),
]);


        // Create or update user
        $user = User::updateOrCreate(
            ['email' => strtolower($googleUser->getEmail())],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');

        } 

    }    
}

