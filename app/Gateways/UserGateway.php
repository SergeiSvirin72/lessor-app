<?php

namespace App\Gateways;

use App\Models\User;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class UserGateway
{
    /**
     * Авторизует или создает нового пользователя через Socialite.
     *
     * @param SocialiteUser $user
     * @return User
     */
    public function socialiteUser(SocialiteUser $user)
    {
        $user = User::firstOrCreate(['email' => $user->email],
            [
                'name' => $user->name,
                'email' => $user->email,
            ]
        );
        return $user;
    }
}
