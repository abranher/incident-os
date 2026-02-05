<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\DocumentType;
use App\Enums\Role as RoleEnum;
use App\Models\Role;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Operation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Unique;

class UserForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        TextInput::make('name')
          ->label('Nombre')
          ->placeholder('Ej: Juan Pérez')
          ->required(),
        TextInput::make('email')
          ->label('Correo electrónico')
          ->placeholder('Ej: ejemplo@dominio.com')
          ->unique()
          ->email()
          ->required(),
        Grid::make(2)
          ->schema([
            Select::make('document_type')
              ->label('Tipo de Documento')
              ->options(DocumentType::class)
              ->required()
              ->native(false),
            TextInput::make('document_number')
              ->label('Número de Documento')
              ->required()
              ->numeric()
              ->placeholder('Ej: 25123456')
              ->minLength(7)
              ->maxLength(9)
              ->unique(
                table: 'users',
                ignoreRecord: true,
                modifyRuleUsing: fn (Unique $rule, callable $get) =>
                  $rule->where('document_type', $get('document_type'))
              )
              ->validationMessages([
                'unique' => 'Este número de documento ya existe en el sistema.',
              ]),
          ]),
        Select::make('roles')
          ->label('Rol')
          ->relationship('roles', 'name')
          ->preload()
          ->searchable()
          ->getOptionLabelFromRecordUsing(fn (Model $record) =>
            RoleEnum::tryFrom($record->name)?->getLabel() ?? $record->name
          )
          ->hiddenOn(Operation::Edit),
        TextInput::make('password')
          ->label('Contraseña')
          ->placeholder('Mínimo 8 caracteres')
          ->password()
          ->rule('confirmed')
          ->required()
          ->revealable()
          ->hiddenOn(Operation::Edit),
        TextInput::make('password_confirmation')
          ->label('Confirmar contraseña')
          ->placeholder('Repita la contraseña anterior')
          ->password()
          ->required()
          ->revealable()
          ->hiddenOn(Operation::Edit),
      ]);
  }
}

