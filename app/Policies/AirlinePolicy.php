<?php

namespace App\Policies;

use App\Models\Airline;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AirlinePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Airline  $airline
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Airline $airline)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Airline  $airline
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Airline $airline)
    {
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Airline  $airline
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Airline $airline)
    {
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Airline  $airline
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Airline $airline)
    {
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Airline  $airline
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Airline $airline)
    {
        return $user->role == 'admin';
    }
}
