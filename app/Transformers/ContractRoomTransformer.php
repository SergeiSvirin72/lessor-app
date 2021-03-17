<?php

namespace App\Transformers;

use App\Models\ContractRoom;
use League\Fractal\TransformerAbstract;

class ContractRoomTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'room', 'contract'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param ContractRoom $contractRoom
     * @return array
     */
    public function transform(ContractRoom $contractRoom)
    {
        return [
            'id' => $contractRoom->id,
            'room_id' => $contractRoom->room_id,
            'contract_id' => $contractRoom->contract_id,
            'moved_at'  => $contractRoom->moved_at,
            'pay_start' => $contractRoom->pay_start,
            'paid_till' => $contractRoom->paid_till,
            'price' => $contractRoom->price,
            'price_square_foot' => $contractRoom->price_square_foot,
        ];
    }

    public function includeContract(ContractRoom $contractRoom)
    {
        $contract = $contractRoom->contract;
        return $this->item($contract, new ContractTransformer);
    }

    public function includeRoom(ContractRoom $contractRoom)
    {
        $room = $contractRoom->room;
        return $this->item($room, new RoomTransformer);
    }
}
