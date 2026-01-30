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
}

