<?php


namespace App\Transformers;

use App\Models\Team;
use League\Fractal\TransformerAbstract;

class TeamTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'estates', 'invite', 'requisites', 'users', 'teamUsers'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Team $team
     * @return array
     */
    public function transform(Team $team)
    {
        return [
            'id' => $team->id,
            'name' => $team->name,
            'alias' => $team->alias
        ];
    }

    public function includeEstates(Team $team)
    {
        $estates = $team->estates;
        return $this->collection($estates, new EstateTransformer);
    }

    public function includeInvite(Team $team)
    {
        $invite = $team->invites()->first();
        return $invite ? $this->item($invite, new InviteTransformer) : null;
    }

    public function includeRequisites(Team $team)
    {
        $requisites = $team->requisites;
        return $this->collection($requisites, new RequisiteTransformer);
    }

    public function includeTeamUsers(Team $team)
    {
        $teamUser = $team->teamUser;
        return $this->collection($teamUser, new TeamUserTransformer);
    }
}
