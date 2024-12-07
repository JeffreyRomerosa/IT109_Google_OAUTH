<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // The constructor where the middleware is applied
    public function __construct()
    {
        // Ensures that only authenticated users can access this controller's methods
        $this->middleware('auth');
    }

    // Update the user's profile name
    public function update(Request $request)
    {
        // Validate the request input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update the user's name
        $user->name = $request->name;
        $user->save();

        // Redirect back to the dashboard with a success message
        return back()->with('status', 'Profile updated successfully!');
    }
}
