<?php

namespace App\Policies;

use App\Enums\Permission as PermissionEnum;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ActivityLogPolicy
{
  /**
   * Determine whether the user can view any models.
   */
  public function viewAny(User $user): bool
  {
    return $user->hasPermissionTo(PermissionEnum::VIEW_ANY_ACTIVITY_LOG->value);
  }

  /**
   * Determine whether the user can view the model.
   */
  public function view(User $user, ActivityLog $activityLog): bool
  {
    return $user->hasPermissionTo(PermissionEnum::VIEW_ACTIVITY_LOG->value);
  }

  /**
   * Determine whether the user can create models.
   */
  public function create(User $user): bool
  {
    return false;
  }

  /**
   * Determine whether the user can update the model.
   */
  public function update(User $user, ActivityLog $activityLog): bool
  {
    return false;
  }

  /**
   * Determine whether the user can delete the model.
   */
  public function delete(User $user, ActivityLog $activityLog): bool
  {
    return false;
  }

  /**
   * Determine whether the user can restore the model.
   */
  public function restore(User $user, ActivityLog $activityLog): bool
  {
    return false;
  }

  /**
   * Determine whether the user can permanently delete the model.
   */
  public function forceDelete(User $user, ActivityLog $activityLog): bool
  {
    return false;
  }
}

