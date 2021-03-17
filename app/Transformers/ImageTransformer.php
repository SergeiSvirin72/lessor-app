<?php


namespace App\Transformers;


use App\Models\Image;
use League\Fractal\TransformerAbstract;

class ImageTransformer extends TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param Image $image
     * @return array
     */
    public function transform(Image $image)
    {
        return [
            'id' => $image->id,
            'img' => $image->img,
            'image_url' => $image->image_url,
            'imageable_id' => $image->imageable_id,
            'imageable_type' => $image->imageable_type,
        ];
    }
}
