<?php

namespace App\Filament\Resources\Roles;

use App\Enums\Role as RoleEnum;
use App\Filament\Resources\Roles\Pages\ListRoles;
use App\Filament\Resources\Roles\Pages\ViewRole;
use App\Filament\Resources\Roles\Schemas\RoleInfolist;
use App\Filament\Resources\Roles\Tables\RolesTable;
use App\Models\Role;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class RoleResource extends Resource
{
  protected static ?string $model = Role::class;

  protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

  protected static ?string $recordTitleAttribute = 'name';

  protected static ?string $modelLabel = 'rol';

  protected static ?string $pluralModelLabel = 'roles';

  public static function getRecordTitle(?Model $record): ?string
  {
    return RoleEnum::tryFrom($record->name)?->getLabel() ?? $record->name;
  }

  public static function infolist(Schema $schema): Schema
  {
    return RoleInfolist::configure($schema);
  }

  public static function table(Table $table): Table
  {
    return RolesTable::configure($table);
  }

  public static function getRelations(): array
  {
    return [
      //
    ];
  }

  public static function getPages(): array
  {
    return [
      'index' => ListRoles::route('/'),
      'view' => ViewRole::route('/{record}'),
    ];
  }
}

