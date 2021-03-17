<?php

namespace App\Policies;

use App\Models\Bill;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BillPolicy
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
     * @param  \App\Models\Bill $bill
     * @param Tenant $tenant
     * @return mixed
     */
    public function view(User $user, Bill $bill, Tenant $tenant)
    {
        return $user->team_id === $tenant->team_id
            && $bill->tenant_id === $tenant->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User $user
     * @param Tenant $tenant
     * @return mixed
     */
    public function create(User $user, Tenant $tenant)
    {
        return $user->team_id === $tenant->team_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Bill $bill
     * @param Tenant $tenant
     * @return mixed
     */
    public function update(User $user, Bill $bill, Tenant $tenant)
    {
        return $user->team_id === $tenant->team_id
            && $bill->tenant_id === $tenant->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bill  $bill
     * @return mixed
     */
    public function delete(User $user, Bill $bill)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bill  $bill
     * @return mixed
     */
    public function restore(User $user, Bill $bill)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bill  $bill
     * @return mixed
     */
    public function forceDelete(User $user, Bill $bill)
    {
        //
    }
}
