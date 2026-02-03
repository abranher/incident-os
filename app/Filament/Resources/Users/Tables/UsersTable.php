<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class UsersTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('name')
          ->label('Nombre')
          ->searchable(),
        TextColumn::make('email')
          ->label('Correo electrónico')
          ->searchable(),
        TextColumn::make('email_verified_at')
          ->label('Email verificado')
          ->sortable()
          ->placeholder('Sin verificar')
          ->date('d/m/Y - g:i A'),
        TextColumn::make('created_at')
          ->label('Fecha de registro')
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true)
          ->date('d/m/Y - g:i A'),
        TextColumn::make('updated_at')
          ->label('Última actualización')
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true)
          ->date('d/m/Y - g:i A'),
        TextColumn::make('deleted_at')
          ->label('Fecha de baja')
          ->sortable()
          ->placeholder('Activo')
          ->toggleable(isToggledHiddenByDefault: true)
          ->date('d/m/Y - g:i A'),
      ])
      ->filters([
        TrashedFilter::make(),
      ])
      ->recordActions([
        ActionGroup::make([
          ViewAction::make(),
          EditAction::make(),
        ]),
      ])
      ->toolbarActions([
        BulkActionGroup::make([
          DeleteBulkAction::make(),
          RestoreBulkAction::make(),
        ]),
      ]);
  }
}

