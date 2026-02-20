<?php

namespace App\Filament\Widgets\Employee;

use App\Enums\IncidentPriority;
use App\Enums\IncidentStatus;
use App\Enums\Role as RoleEnum;
use App\Models\Incident;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class LatestIncidents extends TableWidget
{
  protected static ?string $heading = 'Mis Últimas Incidencias';

  public static function canView(): bool
  {
    return Auth::user()->hasRole(RoleEnum::EMPLOYEE->value);
  }

  public function table(Table $table): Table
  {
    return $table
      ->query(fn (): Builder =>
        Incident::query()
          ->where('user_id', Auth::id())
          ->latest()
          ->limit(5)
      )
      ->columns([
        TextColumn::make('title')
          ->label('Título')
          ->searchable()
          ->wrap(),
        TextColumn::make('status')
          ->badge()
          ->sortable(),
        TextColumn::make('department.name')
          ->label('Departamento')
          ->sortable()
          ->toggleable(),
        TextColumn::make('created_at')
          ->label('Fecha')
          ->date('d/m/Y - g:i A')
          ->sortable(),
      ])
      ->paginated(false)
      ->filters([
        SelectFilter::make('status')
          ->options(IncidentStatus::class)
          ->label('Estado'),
        SelectFilter::make('priority')
          ->options(IncidentPriority::class)
          ->label('Prioridad'),
      ])
      ->headerActions([
        //
      ])
      ->recordActions([
        //
      ]);
  }
}

