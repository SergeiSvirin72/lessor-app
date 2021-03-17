<?php

namespace App\Transformers;

use App\Models\TeamUser;
use League\Fractal\TransformerAbstract;

class TeamUserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'team', 'user'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param TeamUser $teamUser
     * @return array
     */
    public function transform(TeamUser $teamUser)
    {
        return [
            'id' => $teamUser->id,
            'team_id' => $teamUser->team_id,
            'user_id' => $teamUser->user_id,
            'role'  => $teamUser->role,
        ];
    }

    public function includeTeam(TeamUser $teamUser)
    {
        $team = $teamUser->team;
        return $this->item($team, new TeamTransformer);
    }

    public function includeUser(TeamUser $teamUser)
    {
        $user = $teamUser->user;
        return $this->item($user, new UserTransformer);
    }
}