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
        return $admin->hasPermissionTo('index-street') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');

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
        return $admin->hasPermissionTo('show-street') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');

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
        return $admin->hasPermissionTo('create-street') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');

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
        return $admin->hasPermissionTo('update-street') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');

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
        return $admin->hasPermissionTo('delete-street') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');

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
        return $admin->hasPermissionTo('restore-street') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');

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
        return $admin->hasPermissionTo('forceDelete-street') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');

    }
}