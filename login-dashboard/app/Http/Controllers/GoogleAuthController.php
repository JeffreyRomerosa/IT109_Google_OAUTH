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
        ->scopes(['openid', 'profile', 'email']) // Request profile and email information
        ->with(['prompt' => 'select_account'])
        ->redirect();
    }

    // Handle the callback from Google
    public function handleGoogleCallback()
{
    try {
        // Get user data from Google
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Debugging: Check if profile picture is being fetched correctly
        //dd($googleUser); // This will show the avatar URL for debugging

        // Check if the user already exists in the database
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            // Update existing user with the latest Google data
            $user->update([
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'profile_photo_url' => $googleUser->getAvatar(), // Update profile picture
            ]);
        } else {
            // Create a new user if one doesn't exist
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'profile_photo_url' => $googleUser->getAvatar(), // Save profile picture
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
