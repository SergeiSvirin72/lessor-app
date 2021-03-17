<?php

namespace App\Gateways;

use App\Http\Requests\Teams\TeamWebCreateRequest;
use App\Models\Team;
use App\Models\TeamUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeamGateway
{
    /**
     * Создает команду и приглашение, назначет пользователя владельцем команды.
     *
     * @param TeamWebCreateRequest $request
     * @return Team
     */
    public function create(TeamWebCreateRequest $request)
    {
        return DB::transaction(function() use ($request) {
            $team = new Team($request->validated());
            $team->save();
            Auth::user()->teams()->attach($team->id, ['role' => TeamUser::TYPE_OWNER]);
            return $team;
        });
    }
}
