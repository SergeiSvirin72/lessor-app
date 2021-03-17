<?php


namespace App\Transformers;


use App\Models\Floor;
use League\Fractal\TransformerAbstract;

class FloorTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'rooms', 'estate'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Floor $floor
     * @return array
     */
    public function transform(Floor $floor)
    {
        return [
            'id' => $floor->id,
            'name' => $floor->name,
            'img' => $floor->img,
            'image_url' => $floor->image_url,
            'price' => $floor->price,
            'estate_id' => $floor->estate_id,
        ];
    }

    public function includeRooms(Floor $floor)
    {
        $rooms = $floor->rooms;
        return $this->collection($rooms, new RoomTransformer);
    }

    public function includeEstate(Floor $floor)
    {
        $estate = $floor->estate;
        return $this->item($estate, new EstateTransformer);
    }
}
