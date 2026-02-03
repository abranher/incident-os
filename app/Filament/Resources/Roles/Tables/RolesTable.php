<?php

namespace App\Filament\Resources\Roles\Tables;

use App\Enums\Role as RoleEnum;
use App\Filament\Resources\Roles\Pages\EditRole;
use App\Models\Role;
use Filament\Actions\ActionGroup;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RolesTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('name')
          ->label('Nombre')
          ->searchable()
          ->badge()
          ->formatStateUsing(fn (string $state): string => RoleEnum::tryFrom($state)?->getLabel() ?? $state)
          ->color(fn (string $state): string => RoleEnum::tryFrom($state)?->getColor() ?? 'gray')
          ->icon(fn ($state) => RoleEnum::tryFrom($state)?->getIcon() ?? 'heroicon-m-user'),
        TextColumn::make('created_at')
          ->label('Fecha de creación')
          ->sortable()
          ->date('d/m/Y - g:i A'),
        TextColumn::make('updated_at')
          ->label('Última actualización')
          ->sortable()
          ->date('d/m/Y - g:i A'),
      ])
      ->filters([
        //
      ])
      ->recordActions([
        ActionGroup::make([
          ViewAction::make()
        ]),
      ]);
  }
}

