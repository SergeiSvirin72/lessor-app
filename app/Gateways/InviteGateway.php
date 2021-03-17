<?php

namespace App\Gateways;

use App\Models\TeamUser;
use Illuminate\Contracts\Auth\Authenticatable;

class InviteGateway
{
    /**
     * Добавляет пользователя в компанию.
     *
     * @param Authenticatable $user
     * @param $team_id
     */
    public function join(Authenticatable $user, $team_id)
    {
        $user->teams()->syncWithoutDetaching([$team_id => ['role' => TeamUser::TYPE_EMPLOYEE]]);
    }
}
