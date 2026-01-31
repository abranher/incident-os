<?php

namespace App\Filament\Resources\ActivityLogs;

use App\Filament\Resources\ActivityLogs\Pages\ListActivityLogs;
use App\Filament\Resources\ActivityLogs\Pages\ViewActivityLog;
use App\Filament\Resources\ActivityLogs\Schemas\ActivityLogInfolist;
use App\Filament\Resources\ActivityLogs\Tables\ActivityLogsTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Spatie\Activitylog\Models\Activity;
use UnitEnum;

class ActivityLogResource extends Resource
{
  protected static ?string $model = Activity::class;

  protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

  protected static ?string $modelLabel = 'bitácora';

  protected static ?string $pluralModelLabel = 'bitácora';

  protected static string|UnitEnum|null $navigationGroup = 'Seguridad y Auditoría';

  public static function infolist(Schema $schema): Schema
  {
    return ActivityLogInfolist::configure($schema);
  }

  public static function table(Table $table): Table
  {
    return ActivityLogsTable::configure($table)->defaultSort('created_at', 'desc');
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
      'index' => ListActivityLogs::route('/'),
      'view' => ViewActivityLog::route('/{record}'),
    ];
  }
}

