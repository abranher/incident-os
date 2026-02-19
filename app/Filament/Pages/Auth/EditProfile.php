<?php

namespace App\Filament\Pages\Auth;

use App\Enums\DocumentType;
use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Unique;

class EditProfile extends BaseEditProfile
{
  public function form(Schema $schema): Schema
  {
    return $schema
      ->components([
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
        $this->getNameFormComponent(),
        $this->getEmailFormComponent(),
        $this->getPasswordFormComponent(),
        $this->getPasswordConfirmationFormComponent(),
        $this->getCurrentPasswordFormComponent(),
      ]);
  }
}

