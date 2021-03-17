<?php


namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Estate;

class EstateTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'floors', 'images'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Estate $estate
     * @return array
     */
    public function transform(Estate $estate)
    {
        return [
            'id' => $estate->id,
            'name' => $estate->name,
            'info' => $estate->info,
            'address' => $estate->address,
            'price' => $estate->price_square_foot,
            'longitude' => $estate->longitude,
            'latitude' => $estate->latitude,
            'status' => $estate->status,
            'mask' => $estate->mask,
        ];
    }

    public function includeFloors(Estate $estate)
    {
        $floors = $estate->floors;
        return $this->collection($floors, new FloorTransformer);
    }

    public function includeImages(Estate $estate)
    {
        $images = $estate->images;
        return $this->collection($images, new ImageTransformer);
    }
}
