<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class GoogleAuthController extends Controller
{
    // Redirect to Google for authentication
    public function redirectToGoogle()
    {
        // Add 'prompt' to force account selection
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    // Handle the callback from Google
    public function handleGoogleCallback()
    {
        try {
            // Get user data from Google
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Check if the user already exists in the database
            $user = User::where('email', $googleUser->getEmail())->first();

            // If the user doesn't exist, create a new user
            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt(Str::random(24)), // Set a random password
                ]);
            }

            // Log the user in
            Auth::login($user);

            // Redirect to the dashboard
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            // Handle errors (e.g., failed authentication)
            return redirect()->route('login')->with('error', 'Google authentication failed. Please try again.');
        }
    }
}
