<?php

namespace App\Gateways;

use App\Http\Requests\Rooms\RoomWebCreateRequest;
use App\Http\Requests\Rooms\RoomWebRequest;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class RoomGateway
{
    /**
     * Создает помещение и загружает его изображения.
     *
     * @param RoomWebCreateRequest $request
     * @return Room $room
     */
    public function create(RoomWebCreateRequest $request)
    {
        return DB::transaction(function() use ($request) {
            $room = new Room($request->validated());
            $room->save();

            $this->attach($request, $room);

            return $room;
        });
    }

    /**
     * Загружает изображения помещения.
     *
     * @param RoomWebRequest $request
     * @param Room $room
     */
    public function attach(RoomWebRequest $request, Room $room)
    {
        if ($request->has('images')) {
            $imageGateway = app(ImageGateway::class);
            $images = $imageGateway->createAll($request->images, 'public/rooms');
            $room->images()->saveMany($images);
        }
    }
}
