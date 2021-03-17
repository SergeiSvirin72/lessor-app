<?php

namespace App\Transformers;

use App\Models\Balance;
use League\Fractal\TransformerAbstract;

class BalanceTransformer extends TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param Balance $balance
     * @return array
     */
    public function transform(Balance $balance)
    {
        return [
            'id' => $balance->id,
            'tenant_id' => $balance->tenant_id,
            'act_id' => $balance->act_id,
            'amount' => $balance->amount,
            'type' => $balance->type,
            'status' => $balance->status,
            'created_at' => $balance->created_at,
        ];
    }
}