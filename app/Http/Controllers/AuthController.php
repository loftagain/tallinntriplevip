<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
   /* public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        // Handle the authenticated user
        // You can store the user details in your database, log them in, etc.

        // Redirect the user to the desired page
        return redirect()->route('dashboard');
    }*/
}
