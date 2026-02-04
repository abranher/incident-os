<?php

namespace App\Filament\Resources\Departments\Schemas;

use App\Models\Department;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DepartmentInfolist
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        TextEntry::make('name')
          ->label('Nombre'),
        TextEntry::make('moderators_count')
          ->counts('moderators')
          ->label('Moderadores')
          ->badge()
          ->default(0),
        TextEntry::make('created_at')
          ->label('Fecha de creación')
          ->date('d/m/Y - g:i A'),
        TextEntry::make('updated_at')
          ->label('Última actualización')
          ->date('d/m/Y - g:i A'),
        TextEntry::make('deleted_at')
          ->label('Fecha de eliminación')
          ->placeholder('Activo')
          ->date('d/m/Y - g:i A')
          ->visible(fn (Department $record): bool => $record->trashed())
      ]);
  }
}

