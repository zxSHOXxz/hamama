<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Street;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StreetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        //
        foreach (array_keys(config('auth.guards')) as $guard) {

            if (auth()->guard($guard)->check()) {
                return auth()->user()->hasPermissionTo('index-street') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');
            }

        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin)
    {
        //
        foreach (array_keys(config('auth.guards')) as $guard) {

            if (auth()->guard($guard)->check()) {
                return auth()->user()->hasPermissionTo('show-street') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');
            }

        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        //
        foreach (array_keys(config('auth.guards')) as $guard) {

            if (auth()->guard($guard)->check()) {
                return auth()->user()->hasPermissionTo('create-street') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');
            }

        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin)
    {
        //
        foreach (array_keys(config('auth.guards')) as $guard) {

            if (auth()->guard($guard)->check()) {
                return auth()->user()->hasPermissionTo('update-street') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');
            }

        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin)
    {
        //
        foreach (array_keys(config('auth.guards')) as $guard) {

            if (auth()->guard($guard)->check()) {
                return auth()->user()->hasPermissionTo('delete-street') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');
            }

        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin)
    {
        //
        foreach (array_keys(config('auth.guards')) as $guard) {

            if (auth()->guard($guard)->check()) {
                return auth()->user()->hasPermissionTo('restore-street') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');
            }

        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin)
    {
        //
        foreach (array_keys(config('auth.guards')) as $guard) {

            if (auth()->guard($guard)->check()) {
                return auth()->user()->hasPermissionTo('forceDelete-street') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');
            }

        }
    }
}