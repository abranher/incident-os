<?php

namespace App\Filament\Widgets;

use App\Models\ActivityLog;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestActivityLogs extends TableWidget
{
  protected static ?string $heading = 'Actividad reciente';

  protected int|string|array $columnSpan = 'full';

  protected static ?int $sort = 3;

  public function table(Table $table): Table
  {
    return $table
      ->query(fn (): Builder => ActivityLog::query()->with(['causer'])->latest()->limit(5))
      ->columns([
        TextColumn::make('created_at')
          ->label('Fecha')
          ->date('d/m/Y - g:i A')
          ->timezone('America/Caracas')
          ->sortable(),
        TextColumn::make('log_name')
          ->label('Módulo')
          ->badge()
          ->searchable(),
        TextColumn::make('event')
          ->label('Evento')
          ->badge()
          ->formatStateUsing(fn(string $state): string => translate_activity_event($state))
          ->color(fn(string $state): string => get_activity_color($state))
          ->searchable(),
        TextColumn::make('description')
          ->label('Descripción'),
        TextColumn::make('causer.name')
          ->label('Causado por')
          ->default('Sistema'),
      ])
      ->paginated(false)
      ->filters([
        //
      ])
      ->headerActions([
        //
      ])
      ->recordActions([
        //
      ]);
  }
}

