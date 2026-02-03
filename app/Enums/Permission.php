<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Permission: string implements HasLabel
{
  // USERS
  case VIEW_ANY_USER     = 'view_any_user';
  case VIEW_USER         = 'view_user';
  case CREATE_USER       = 'create_user';
  case UPDATE_USER       = 'update_user';
  case DELETE_USER       = 'delete_user';
  case RESTORE_USER      = 'restore_user';

  // ROLES
  case VIEW_ANY_ROLE     = 'view_any_role';
  case VIEW_ROLE         = 'view_role';

  // ACTIVITY LOGS
  case VIEW_ANY_ACTIVITY_LOG = 'view_any_activity_log';
  case VIEW_ACTIVITY_LOG     = 'view_activity_log';

  public function getCategory(): string
  {
    return match (true) {
      str_contains($this->value, '_user')         => 'USUARIOS',
      str_contains($this->value, '_role')         => 'ROLES',
      str_contains($this->value, '_activity_log') => 'BITÁCORA',
      default => 'SISTEMA',
    };
  }

  public function getLabel(): ?string
  {
    return match ($this) {
      // USERS
      static::VIEW_ANY_USER     => 'Ver todos los usuarios',
      static::VIEW_USER         => 'Ver detalle de usuario',
      static::CREATE_USER       => 'Crear usuario',
      static::UPDATE_USER       => 'Editar usuario',
      static::DELETE_USER       => 'Eliminar usuario',
      static::RESTORE_USER      => 'Restaurar usuario',

      // ROLES
      static::VIEW_ANY_ROLE     => 'Ver todos los roles',
      static::VIEW_ROLE         => 'Ver detalle de rol',

      // ACTIVITY LOGS
      static::VIEW_ANY_ACTIVITY_LOG => 'Ver bitácora del sistema',
      static::VIEW_ACTIVITY_LOG     => 'Ver detalle de bitácora',
    };
  }
}

