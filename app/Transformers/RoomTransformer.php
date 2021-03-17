<?php


namespace App\Transformers;

use App\Models\Room;
use League\Fractal\TransformerAbstract;

class RoomTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'floor', 'images', 'contractRooms'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Room $room
     * @return array
     */
    public function transform(Room $room)
    {
        return [
            'id' => $room->id,
            'name' => $room->name,
            'size' => $room->size,
            'price' => $room->price,
            'floor_id' => $room->floor_id,
            'coordinates' => $room->coordinates,
            'type' => $room->type,
//            'status' => $room->status,
        ];
    }

    public function includeFloor(Room $room)
    {
        $floor = $room->floor;
        return $this->item($floor, new FloorTransformer);
    }

    public function includeImages(Room $room)
    {
        $images = $room->images;
        return $this->collection($images, new ImageTransformer);
    }

    public function includeContractRooms(Room $room)
    {
        $contractRooms = $room->contractRooms;
        return $this->collection($contractRooms, new ContractRoomTransformer());
    }
}
