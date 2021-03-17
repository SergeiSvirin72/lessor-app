<?php

namespace App\Http\Controllers;

use App\Gateways\UserGateway;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function handleProviderCallback($driver, UserGateway $gateway)
    {
        $user = Socialite::driver($driver)->stateless()->user();
        $user = $gateway->socialiteUser($user);
        Auth::login($user);
        return redirect('/teams');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
