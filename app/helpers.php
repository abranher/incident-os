<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

if (!function_exists('model_to_spanish')) {
  function model_to_spanish(string $model, $plural = false)
  {
    $spanish = match ($model) {
      Permission::class => 'Permiso',
      Role::class => 'Rol',
      User::class => 'Usuario',
    };

    if (!$spanish) return null;
    if (!$plural) return $spanish;

    $str = str($spanish);
    $last = $str->charAt($str->length() - 1);
    $suffix = $last === 'd' || $last === 'r' || $last === 'l' ? 'es' : 's';
    return $str->append($suffix);
  }
}

if (!function_exists('translate_activity_verb')) {
  function translate_activity_verb(string $eventName): string
  {
    return match ($eventName) {
      // Eventos CRUD
      'created' => 'creado',
      'updated' => 'actualizado',
      'deleted' => 'archivado',
      'restored' => 'desarchivado',
      // Eventos de Autenticación
      'authenticated' => 'inició sesión',
      'logged_out' => 'cerró sesión',
      'login_failed' => 'falló el inicio de sesión',
      default => $eventName,
    };
  }
}

if (!function_exists('translate_activity_event')) {
  function translate_activity_event(string $eventName): string
  {
    return match ($eventName) {
      // Eventos CRUD
      'created' => 'Creación',
      'updated' => 'Actualización',
      'deleted' => 'Archivado',
      'restored' => 'Desarchivado',
      // Eventos de Autenticación
      'authenticated' => 'Inicio de Sesión',
      'logged_out' => 'Cierre de Sesión',
      'login_failed' => 'Fallo de Inicio de Sesión',
      default => $eventName,
    };
  }
}

if (!function_exists('get_activity_color')) {
  function get_activity_color(string $eventName): string
  {
    return match ($eventName) {
      // Eventos CRUD
      'created' => 'success',
      'updated' => 'warning',
      'deleted' => 'danger',
      'restored' => 'success',
      // Eventos de Autenticación
      'authenticated' => 'success',
      'logged_out' => 'info',
      'login_failed' => 'danger',
      default => 'secondary',
    };
  }
}

