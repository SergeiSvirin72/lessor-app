<?php

namespace App\Http\Controllers;

use App\Gateways\EstateGateway;
use App\Http\Requests\Estates\EstateWebCreateRequest;
use App\Http\Requests\Publics\RoomFilterRequest;
use App\Models\Estate;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('estates.index', [
            'estates' => Auth::user()->team->estates()->with('images')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('estates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EstateWebCreateRequest $request
     * @param EstateGateway $gateway
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EstateWebCreateRequest $request, EstateGateway $gateway)
    {
        $gateway->create($request);
        return redirect('estates');
    }

    /**
     * Display the specified resource.
     *
     * @param Estate $estate
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Estate $estate)
    {
        $this->authorize('view', $estate);

        return view('estates.show', [
            'estate' => $estate,
            'floors' => $estate->floors,
            'images' => $estate->images,
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

    public function publicIndex(Team $team) {
        $estates = $team->estates()->active()->with('images')->get();

        return view('public.estate_index', [
            'team' => $team,
            'estates' => $estates
        ]);
    }

    public function publicShow(RoomFilterRequest $request, Team $team, Estate $estate) {
        $rooms = $estate->rooms()
            ->where('floor_id',$request->floor_id ?: $estate->floors()->first()->id)
            ->when($request->status === 'free', function ($query) {
                return $query->free();
            })
            ->when($request->status === 'not_free', function ($query) {
                return $query->notFree();
            })->get();

        return view('public.estate_show', [
            'estate' => $estate,
            'floors' => $estate->floors,
            'images' => $estate->images,
            'rooms' => $rooms
        ]);
    }
}
