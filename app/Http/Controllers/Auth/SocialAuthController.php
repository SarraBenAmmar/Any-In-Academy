<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; // Adjust based on your User model
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Find or create the user in your database
        $user = User::firstOrCreate([
            'email' => $googleUser->getEmail(),
        ], [
            'name' => $googleUser->getName(),
            'password' => bcrypt(str_random(16)), // Generate a random password
        ]);

        Auth::login($user);

        return redirect()->route('home'); // Redirect to your desired route
    }

    public function handleLinkedinCallback()
    {
        $linkedinUser = Socialite::driver('linkedin')->user();

        // Find or create the user in your database
        $user = User::firstOrCreate([
            'email' => $linkedinUser->getEmail(),
        ], [
            'name' => $linkedinUser->getName(),
            'password' => bcrypt(str_random(16)), // Generate a random password
        ]);

        Auth::login($user);

        return redirect()->route('home'); // Redirect to your desired route
    }
    public function handleFacebookCallback()
    {
        $facebookUser = Socialite::driver('facebook')->user();

        // Find or create the user in your database
        $user = User::firstOrCreate([
            'email' => $facebookUser->getEmail(),
        ], [
            'name' => $facebookUser->getName(),
            'password' => bcrypt(str_random(16)), // Generate a random password
        ]);

        Auth::login($user);

        return redirect()->route('home'); // Redirect to your desired route
    }

}
