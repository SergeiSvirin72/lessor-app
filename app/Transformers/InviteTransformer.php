<?php

namespace App\Transformers;

use App\Models\Invite;
use League\Fractal\TransformerAbstract;

class InviteTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'team'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Invite $invite
     * @return array
     */
    public function transform(Invite $invite)
    {
        return [
            'id' => $invite->id,
            'team_id' => $invite->team_id,
            'token' => $invite->token
        ];
    }

    public function includeTeam(Invite $invite)
    {
        $team = $invite->team;
        return $this->item($team, new TeamTransformer);
    }
}
