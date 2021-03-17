<?php

namespace App\Http\Controllers;

use App\Gateways\RoomGateway;
use App\Http\Requests\Rooms\RoomWebCreateRequest;
use App\Models\Estate;
use App\Models\Floor;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Estate $estate
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Estate $estate)
    {
        $this->authorize('create', [Room::class, $estate]);

        return view('rooms.create', [
            'estate' => $estate,
            'floors' => $estate->floors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoomWebCreateRequest $request
     * @param RoomGateway $gateway
     * @param Estate $estate
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(RoomWebCreateRequest $request, RoomGateway $gateway, Estate $estate)
    {
        $this->authorize('create', [Room::class, $estate]);

        $gateway->create($request);
        return redirect('/estates/'.$estate->id);
    }

    /**
     * Display the specified resource.
     *
     * @param Estate $estate
     * @param Room $room
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Estate $estate, Room $room)
    {
        $this->authorize('view', [$room, $estate]);

        return view('rooms.show', [
            'estate' => $estate,
            'room' => $room,
            'floor' => $room->floor,
            'images' => $room->images,
            'contractRooms' => $room->contractRooms()->with('contract.tenants')->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }

    public function floor_img(Request $request) {
        $floor = Floor::where('id', $request->json('value'))->first();
        return view('rooms.floor_img', [
            'floor' => $floor,
        ]);
    }

    public function publicShow(Estate $estate, Room $room) {
        return view('public.room_show', [
            'estate' => $estate,
            'room' => $room,
            'floor' => $room->floor,
            'images' => $room->images,
        ]);
    }
}
