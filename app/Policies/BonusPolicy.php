<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\bonus;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BonusPolicy
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
        return $admin->hasPermissionTo('index-bonus') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\bonus  $bonus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin)
    {
        //
        return $admin->hasPermissionTo('show-bonus') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');
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
        return $admin->hasPermissionTo('create-bonus') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\bonus  $bonus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin)
    {
        //
        return $admin->hasPermissionTo('update-bonus') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\bonus  $bonus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin)
    {
        //
        return $admin->hasPermissionTo('delete-bonus') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\bonus  $bonus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin)
    {
        //
        return $admin->hasPermissionTo('restore-bonus') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\bonus  $bonus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin)
    {
        //
        return $admin->hasPermissionTo('forceDelete-bonus') ? $this->allow() : $this->deny('لا تملك صلاحية هذا الاجراء');
    }
}