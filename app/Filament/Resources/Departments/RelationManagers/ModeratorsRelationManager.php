<?php

namespace App\Filament\Resources\Departments\RelationManagers;

use App\Enums\Role as RoleEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ModeratorsRelationManager extends RelationManager
{
  protected static string $relationship = 'moderators';

  protected static ?string $recordTitleAttribute = 'name';

  protected static ?string $title = 'Moderadores';

  public function table(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('name')
          ->label('Nombre')
          ->searchable(),
        TextColumn::make('email')
          ->label('Correo electrónico')
          ->searchable(),
      ])
      ->filters([
        //
      ])
      ->headerActions([
        AttachAction::make()
          ->label('Asignar Moderador')
          ->modalHeading('Asignar Moderador al Departamento')
          ->preloadRecordSelect()
          ->recordSelectOptionsQuery(fn (Builder $query) =>
            $query->whereHas('roles', fn ($q) => $q->where('name', RoleEnum::MODERATOR))
          ),
      ])
      ->recordActions([
        ActionGroup::make([
          DetachAction::make(),
        ]),
      ])
      ->toolbarActions([
        BulkActionGroup::make([
          DetachBulkAction::make(),
        ]),
      ]);
  }
}

