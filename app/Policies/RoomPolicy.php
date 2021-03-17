<?php

namespace App\Policies;

use App\Models\Estate;
use App\Models\Room;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoomPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Room $room
     * @param Estate $estate
     * @return mixed
     */
    public function view(User $user, Room $room, Estate $estate)
    {
        return $user->team_id === $estate->team_id
            && $room->floor->estate_id === $estate->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User $user
     * @param Estate $estate
     * @return mixed
     */
    public function create(User $user, Estate $estate)
    {
        return $user->team_id === $estate->team_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $room
     * @return mixed
     */
    public function update(User $user, Room $room)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $room
     * @return mixed
     */
    public function delete(User $user, Room $room)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $room
     * @return mixed
     */
    public function restore(User $user, Room $room)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $room
     * @return mixed
     */
    public function forceDelete(User $user, Room $room)
    {
        //
    }
}
