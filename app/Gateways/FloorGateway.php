<?php

namespace App\Gateways;

use App\Http\Requests\Floors\FloorWebCreateRequest;
use App\Models\Floor;

class FloorGateway
{
    /**
     * Создает этаж и загружает его план.
     *
     * @param FloorWebCreateRequest $request
     * @return Floor
     */
    function create(FloorWebCreateRequest $request)
    {
        $floor = new Floor($request->validated());

        if ($request->has('img')) {
            $image = $request->img->store('public/floors');
            $floor->fill(['img' => $image]);
        }

        $request->estate->floors()->save($floor);
        return $floor;
    }
}
