<?php


namespace App\Transformers;


use App\Models\Requisite;
use League\Fractal\TransformerAbstract;

class RequisiteTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'team'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Requisite $requisite
     * @return array
     */
    public function transform(Requisite $requisite)
    {
        return [
            'id' => $requisite->id,
            'name' => $requisite->name,
            'inn' => $requisite->inn,
            'bik' => $requisite->bik,
            'account' => $requisite->account,
            'team_id' => $requisite->team_id,
        ];
    }

    public function includeTeam(Requisite $requisite)
    {
        $team = $requisite->team;
        return $this->item($team, new TeamTransformer);
    }
}
