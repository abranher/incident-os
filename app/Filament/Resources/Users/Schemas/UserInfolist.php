<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        TextEntry::make('name')
          ->label('Nombre'),
        TextEntry::make('email')
          ->label('Correo electrónico'),
        TextEntry::make('email_verified_at')
          ->label('Email verificado')
          ->placeholder('Sin verificar')
          ->date('d/m/Y - g:i A')
          ->timezone('America/Caracas'),
        TextEntry::make('created_at')
          ->label('Fecha de registro')
          ->date('d/m/Y - g:i A')
          ->timezone('America/Caracas'),
        TextEntry::make('updated_at')
          ->label('Última actualización')
          ->date('d/m/Y - g:i A')
          ->timezone('America/Caracas'),
        TextEntry::make('deleted_at')
          ->label('Fecha de baja')
          ->visible(fn (User $record): bool => $record->trashed())
          ->date('d/m/Y - g:i A')
          ->timezone('America/Caracas'),
      ]);
  }
}
