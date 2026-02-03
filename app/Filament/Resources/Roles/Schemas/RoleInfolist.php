<?php

namespace App\Filament\Resources\Roles\Schemas;

use App\Enums\Permission as PermissionEnum;
use App\Enums\Role as RoleEnum;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RoleInfolist
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make('Información del Rol')
          ->description('Detalles principales de la identidad del rol.')
          ->icon('heroicon-m-identification')
          ->schema([
            TextEntry::make('name')
              ->label('Nombre Identificador')
              ->badge()
              ->formatStateUsing(fn (string $state): string => RoleEnum::tryFrom($state)?->getLabel() ?? $state)
              ->color(fn (string $state): string => RoleEnum::tryFrom($state)?->getColor() ?? 'gray')
              ->icon(fn ($state) => RoleEnum::tryFrom($state)?->getIcon() ?? 'heroicon-m-user'),
          ]),
        Section::make('Capacidades y Permisos')
          ->description('Lista de acciones permitidas para este rol.')
          ->icon('heroicon-m-key')
          ->schema([
            TextEntry::make('permissions.name')
              ->label('Permisos')
              ->listWithLineBreaks()
              ->badge()
              ->color('info')
              ->formatStateUsing(function (string $state): string {
                $permission = PermissionEnum::tryFrom($state);
                if (!$permission) return $state;
                return "{$permission->getCategory()}: {$permission->getLabel()}";
              })
          ])
          ->collapsible(),
      ]);
  }
}

