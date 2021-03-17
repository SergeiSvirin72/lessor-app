<?php

namespace App\Http\Controllers;

use App\Gateways\FloorGateway;
use App\Http\Requests\Floors\FloorWebCreateRequest;
use App\Models\Estate;
use App\Models\Floor;
use Illuminate\Http\Request;

class FloorController extends Controller
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
        $this->authorize('create', [Floor::class, $estate]);

        return view('floors.create', [
            'estate' => $estate
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FloorWebCreateRequest $request
     * @param Estate $estate
     * @param FloorGateway $gateway
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(FloorWebCreateRequest $request, Estate $estate, FloorGateway $gateway)
    {
        $this->authorize('create', [Floor::class, $estate]);

        $gateway->create($request);
        return redirect('/estates/'.$estate->id);
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

    /**
     * Return floor's rooms view.
     *
     * @param Floor $floor
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function rooms(Floor $floor)
    {
        return view('estates.rooms', [
            'estate' => $floor->estate,
            'rooms' => $floor->rooms,
        ]);
    }

    /**
     * Return floor's image URL.
     *
     * @param Floor $floor
     * @return string
     */
    public function img(Floor $floor)
    {
        return $floor->image_url;
    }
}
