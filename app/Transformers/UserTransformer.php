<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'teams', 'teamUsers'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];
    }

    public function includeTeams(User $user)
    {
        $teams = $user->teams;
        return $this->collection($teams, new TeamTransformer);
    }

    public function includeTeamUsers(User $user)
    {
        $teamUser = $user->teamUser;
        return $this->collection($teamUser, new TeamUserTransformer);
    }
}