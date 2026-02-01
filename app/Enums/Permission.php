<?php

namespace App\Enums;

enum Permission: string
{
  // USERS
  case VIEW_ANY_USER     = 'view_any_user';
  case VIEW_USER         = 'view_user';
  case CREATE_USER       = 'create_user';
  case UPDATE_USER       = 'update_user';
  case DELETE_USER       = 'delete_user';
  case RESTORE_USER      = 'restore_user';
  case FORCE_DELETE_USER = 'force_delete_user';

  // ROLES
  case VIEW_ANY_ROLE     = 'view_any_role';
  case VIEW_ROLE         = 'view_role';
  case CREATE_ROLE       = 'create_role';
  case UPDATE_ROLE       = 'update_role';
  case DELETE_ROLE       = 'delete_role';
  case RESTORE_ROLE      = 'restore_role';
  case FORCE_DELETE_ROLE = 'force_delete_role';

  // PERMISSIONS
  case VIEW_ANY_PERMISSION = 'view_any_permission';
  case VIEW_PERMISSION     = 'view_permission';

  // ACTIVITY LOGS
  case VIEW_ANY_ACTIVITY_LOG = 'view_any_activity_log';
  case VIEW_ACTIVITY_LOG     = 'view_activity_log';
}

