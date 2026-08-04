<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();


        $user = User::where('email', $googleUser->email)->first();


        if (!$user) {
            return redirect('/login')
                ->with('error', 'Este correo no está registrado en el sistema.');
        }


        Auth::login($user);


        return redirect('/panel');
    }
}