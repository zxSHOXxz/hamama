<?php

namespace App\Policies;

use App\Models\Envelope;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EnvelopePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny()
    {
        foreach (array_keys(config('auth.guards')) as $guard) {

            if (auth()->guard($guard)->check()) {
                return auth()->user()->hasPermissionTo('index-envelope') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');
            }

        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Envelope  $envelope
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Envelope $envelope)
    {
        foreach (array_keys(config('auth.guards')) as $guard) {

            if (auth()->guard($guard)->check()) {
                return auth()->user()->hasPermissionTo('show-envelope') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');
            }

        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create()
    {
        foreach (array_keys(config('auth.guards')) as $guard) {

            if (auth()->guard($guard)->check()) {
                return auth()->user()->hasPermissionTo('create-envelope') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');
            }

        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Envelope  $envelope
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Envelope $envelope)
    {
        foreach (array_keys(config('auth.guards')) as $guard) {

            if (auth()->guard($guard)->check()) {
                return auth()->user()->hasPermissionTo('update-envelope') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');
            }

        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Envelope  $envelope
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Envelope $envelope)
    {
        foreach (array_keys(config('auth.guards')) as $guard) {

            if (auth()->guard($guard)->check()) {
                return auth()->user()->hasPermissionTo('delete-envelope') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');
            }

        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Envelope  $envelope
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Envelope $envelope)
    {

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Envelope  $envelope
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Envelope $envelope)
    {

    }
}