<?php

namespace App\Http\Controllers;

use App\Gateways\ApplicationGateway;
use App\Http\Requests\Applications\ApplicationWebCreateRequest;
use App\Models\Application;
use App\Models\Estate;
use App\Models\Room;
use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Application::notHandled()->whereHas('room.floor.estate', function (Builder $query) {
            $query->where('estates.team_id', Auth::user()->team_id);
        })->with('room.floor.estate')->get();

        return view('applications.index', [
            'applications' => $applications
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Team $team
     * @param Estate $estate
     * @param Room $room
     * @return \Illuminate\Http\Response
     */
    public function create(Team $team, Estate $estate, Room $room)
    {
        return view('public.room_show', [
            'estate' => $estate,
            'room' => $room,
            'floor' => $room->floor,
            'images' => $room->images,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ApplicationWebCreateRequest $request
     * @param Team $team
     * @param Estate $estate
     * @param Room $room
     * @param ApplicationGateway $gateway
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ApplicationWebCreateRequest $request, Team $team, Estate $estate, Room $room, ApplicationGateway $gateway)
    {
        $application = $gateway->create($request);
        return redirect('/estates/'.$estate->id.'/rooms/'.$room->id.'#application')->with('status', $application);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Application $application
     * @param ApplicationGateway $gateway
     * @return \Illuminate\Http\Response
     */
    public function update(Application $application, ApplicationGateway $gateway)
    {
        $gateway->update($application);
        return redirect('/applications');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
