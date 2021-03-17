<?php

namespace App\Http\Controllers;

use App\Gateways\ContractRoomGateway;
use App\Http\Requests\ContractRoom\ContractRoomWebCreateRequest;
use App\Models\ContractRoom;
use App\Models\Floor;
use App\Models\Room;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractRoomController extends Controller
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
     * @param Tenant $tenant
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Tenant $tenant)
    {
        $this->authorize('create', [ContractRoom::class, $tenant]);

        return view('contract_rooms.create', [
            'tenant' => $tenant,
            'estates' => Auth::user()->team->estates,
            'contracts' => $tenant->contracts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContractRoomWebCreateRequest $request
     * @param ContractRoomGateway $gateway
     * @param Tenant $tenant
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(ContractRoomWebCreateRequest $request, ContractRoomGateway $gateway, Tenant $tenant)
    {
        $this->authorize('create', [ContractRoom::class, $tenant]);

        $gateway->create($request);
        return redirect('/tenants/'.$tenant->id.'?tab=estates#tab');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        //
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

    public function floors(Request $request) {
        $floors = Floor::where('estate_id', $request->json('value'))->get();

        return view('contract_rooms.floors', [
            'floors' => $floors,
        ]);
    }

    public function rooms(Request $request) {
        $rooms = Room::where('floor_id', $request->json('value'))->get();

        return view('contract_rooms.rooms', [
            'rooms' => $rooms,
        ]);
    }

    public function floor_img(Request $request) {
        $floor = Floor::where('id', $request->json('value'))->first();
        return view('contract_rooms.floor_img', [
            'floor' => $floor,
        ]);
    }

    public function room_coordinates(Request $request) {
        $room = Room::where('id', $request->json('value'))->first();
        return response()->json(['room' => $room]);
    }
}
