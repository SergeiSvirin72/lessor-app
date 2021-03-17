<?php

namespace App\Gateways;

use App\Http\Requests\Estates\EstateWebCreateRequest;
use App\Http\Requests\Estates\EstateWebRequest;
use App\Models\Estate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstateGateway
{
    /**
     * Создает здание и загружает его изображения.
     *
     * @param EstateWebCreateRequest $request
     * @return Estate
     */
    public function create(EstateWebCreateRequest $request)
    {
        return DB::transaction(function() use ($request) {
            $estate = new Estate($request->validated());
            Auth::user()->team->estates()->save($estate);

            $this->attach($request, $estate);

            return $estate;
        });
    }

    /**
     * Загружает изображения здания.
     *
     * @param EstateWebRequest $request
     * @param Estate $estate
     */
    public function attach(EstateWebRequest $request, Estate $estate)
    {
        if ($request->has('images')) {
            $imageGateway = app(ImageGateway::class);
            $images = $imageGateway->createAll($request->images, 'public/estates');
            $estate->images()->saveMany($images);
        }
    }
}
