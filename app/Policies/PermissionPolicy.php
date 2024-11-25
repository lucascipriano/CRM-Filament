<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Permission;

class PermissionPolicy
{
    /**
     * Determine whether the user can view any permissions.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('permission_read');
    }

    /**
     * Determine whether the user can view a specific permission.
     */
    public function view(User $user, Permission $permission): bool
    {
        return $user->hasPermissionTo('permission_read');
    }

    /**
     * Determine whether the user can create permissions.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('permission_create');
    }

    /**
     * Determine whether the user can update a permission.
     */
    public function update(User $user, Permission $permission): bool
    {
        return $user->hasPermissionTo('permission_update');
    }

    /**
     * Determine whether the user can delete a permission.
     */
    public function delete(User $user, Permission $permission): bool
    {
        return $user->hasPermissionTo('permission_delete');
    }
}
