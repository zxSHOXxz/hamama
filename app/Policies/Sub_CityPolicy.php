<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\sub_city;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Sub_CityPolicy
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
        return $admin->hasPermissionTo('index-sub-city') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\sub_city  $subCity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin)
    {
        //
        return $admin->hasPermissionTo('show-sub-city') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');

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
        return $admin->hasPermissionTo('create-sub-city') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\sub_city  $subCity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin)
    {
        //
        return $admin->hasPermissionTo('update-sub-city') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\sub_city  $subCity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin)
    {
        //
        return $admin->hasPermissionTo('delete-sub-city') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\sub_city  $subCity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin)
    {
        //
        return $admin->hasPermissionTo('index-sub-city') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\sub_city  $subCity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin)
    {
        //
        return $admin->hasPermissionTo('index-sub-city') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');

    }
}