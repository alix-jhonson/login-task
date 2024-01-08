<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function login_with_google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback_from_google()
    {
        try {
            $user = Socialite::driver('google')->user();
            $is_user = User::where('email', $user->getEmail())->first();

            if (!$is_user) {
                // Create a new user if they don't exist
                $newUser = User::create([
                    'google_id' => $user->getId(),
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make($user->getName() . '@' . $user->getId()),
                ]);
            }

            // Log in the user (you may adjust this part as needed)
            Auth::login($is_user ?? $newUser);

            // Redirect to the desired page after login
            return redirect()->route('home'); // Replace 'home' with your desired route

        } catch (\Throwable $th) {
            // Handle any exceptions here
            throw $th;
        }
    }
}

