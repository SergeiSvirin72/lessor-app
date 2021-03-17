<?php

namespace App\Gateways;

use App\Models\Image;
use Illuminate\Http\UploadedFile;

class ImageGateway
{
    /**
     * Загружает изображение.
     *
     * @param UploadedFile $image
     * @param string $path
     * @return Image
     */
    public function create(UploadedFile $image, $path)
    {
        $path = $image->store($path);
        $image = new Image(['img' => $path]);
        return $image;
    }

    /**
     * Загружает массив изображений.
     *
     * @param array $images
     * @param string $path
     * @return array
     */
    public function createAll(array $images, $path)
    {
        $collection = [];
        foreach($images as $image) {
            $collection[] = $this->create($image, $path);
        }
        return $collection;
    }
}