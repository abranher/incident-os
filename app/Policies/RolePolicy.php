<?php

namespace App\Policies;

use App\Enums\Permission as PermissionEnum;
use App\Enums\Role as RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
  /**
   * Determine if the role is Super admin.
   */
  private function isProtectedRole(Role $role): bool
  {
    return $role->name === RoleEnum::SUPER_ADMIN->value;
  }

  /**
   * Determine whether the user can view any models.
   */
  public function viewAny(User $user): bool
  {
    return $user->hasPermissionTo(PermissionEnum::VIEW_ANY_ROLE->value);
  }

  /**
   * Determine whether the user can view the model.
   */
  public function view(User $user, Role $role): bool
  {
    return $user->hasPermissionTo(PermissionEnum::VIEW_ROLE->value);
  }

  /**
   * Determine whether the user can create models.
   */
  public function create(User $user): bool
  {
    return $user->hasPermissionTo(PermissionEnum::CREATE_ROLE->value);
  }

  /**
   * Determine whether the user can update the model.
   */
  public function update(User $user, Role $role): bool
  {
    if ($this->isProtectedRole($role)) return false;

    return $user->hasPermissionTo(PermissionEnum::UPDATE_ROLE->value);
  }

  /**
   * Determine whether the user can delete the model.
   */
  public function delete(User $user, Role $role): bool
  {
    if ($this->isProtectedRole($role)) return false;

    return $user->hasPermissionTo(PermissionEnum::DELETE_ROLE->value);
  }

  /**
   * Determine whether the user can restore the model.
   */
  public function restore(User $user, Role $role): bool
  {
    if ($this->isProtectedRole($role)) return false;

    return $user->hasPermissionTo(PermissionEnum::RESTORE_ROLE->value);
  }

  /**
   * Determine whether the user can permanently delete the model.
   */
  public function forceDelete(User $user, Role $role): bool
  {
    if ($this->isProtectedRole($role)) return false;

    return $user->hasPermissionTo(PermissionEnum::FORCE_DELETE_ROLE->value);
  }
}

