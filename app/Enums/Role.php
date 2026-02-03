<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum Role: string implements HasColor, HasIcon, HasLabel
{
  case SUPER_ADMIN = 'super_admin';
  case MODERATOR = 'moderator';
  case EMPLOYEE = 'employee';

  public function getLabel(): ?string
  {
    return match ($this) {
      static::SUPER_ADMIN => 'Super Administrador',
      static::MODERATOR => 'Moderador',
      static::EMPLOYEE => 'Empleado',
    };
  }

  public function getColor(): string|array|null
  {
    return match ($this) {
      static::SUPER_ADMIN => 'primary',
      static::MODERATOR => 'danger',
      static::EMPLOYEE => 'success',
    };
  }

  public function getIcon(): ?string
  {
    return match ($this) {
      static::SUPER_ADMIN => 'heroicon-m-shield-check',
      static::MODERATOR => 'heroicon-m-wrench-screwdriver',
      static::EMPLOYEE => 'heroicon-m-clipboard-document-list',
    };
  }
}

