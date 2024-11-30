<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleAuthController;
use Illuminate\Support\Facades\Auth; // Ensure this is imported for checking authentication

// Google Login Routes
Route::get('google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google');
Route::get('google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

// Public route for the home page
Route::get('/', function () {
    // Redirect to login if not authenticated, otherwise to dashboard
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Sign-Up routes
Route::get('/signup', [AuthController::class, 'showSignUpForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'register']);

// Public routes for login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Protected routes for authenticated users
Route::middleware('auth')->group(function () {
    // Dashboard route
    Route::get('/dashboard', function () {
        return view('dashboard'); // This points to the 'dashboard.blade.php' view
    })->name('dashboard');

    // Logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

