<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Check if user already exists
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // User exists, check if they signed up with Google before
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->getId()]);
                }

                Auth::login($user, true);
            } else {
                // User doesn't exist, create a new one
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt(Str::random(16)), // Need a random password for users created via Google
                    'email_verified_at' => now(), // Assume Google's email is verified
                    'role' => 'client', // Default role
                ]);

                Auth::login($user, true);
            }

            return redirect()->intended(route('dashboard', absolute: false));

        } catch (\Exception $e) {
            return redirect(route('login'))->withErrors([
                'email' => 'Failed to authenticate with Google. Please try again.'
            ]);
        }
    }
}
