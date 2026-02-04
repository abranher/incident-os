<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\Role as RoleEnum;
use App\Models\Role;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Support\Enums\Operation;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class UserForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        TextInput::make('name')
          ->label('Nombre')
          ->required(),
        TextInput::make('email')
          ->label('Correo electrónico')
          ->unique()
          ->email()
          ->required(),
        TextInput::make('password')
          ->label('Contraseña')
          ->password()
          ->rule('confirmed')
          ->required()
          ->revealable()
          ->hiddenOn(Operation::Edit),
        TextInput::make('password_confirmation')
          ->label('Confirmar contraseña')
          ->password()
          ->required()
          ->revealable()
          ->hiddenOn(Operation::Edit),
        Select::make('roles')
          ->label('Rol')
          ->relationship('roles', 'name')
          ->preload()
          ->searchable()
          ->getOptionLabelFromRecordUsing(fn (Model $record) =>
            RoleEnum::tryFrom($record->name)?->getLabel() ?? $record->name
          ),
      ]);
  }
}

