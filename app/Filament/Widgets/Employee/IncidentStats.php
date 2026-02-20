<?php

namespace App\Filament\Widgets\Employee;

use App\Enums\IncidentStatus;
use App\Enums\Role as RoleEnum;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class IncidentStats extends StatsOverviewWidget
{
  protected ?string $heading = 'Seguimiento de mis Incidencias';

  public static function canView(): bool
  {
    return Auth::user()->hasRole(RoleEnum::EMPLOYEE->value);
  }

  protected function getStats(): array
  {
    $user = Auth::user();

    return [
      Stat::make('Mis Incidencias Reportadas', $user->reportedIncidents()->count())
        ->description('Total Reportado')
        ->descriptionIcon(Heroicon::OutlinedExclamationTriangle)
        ->color('gray'),
      Stat::make('Mis Incidencias En Proceso', $user->reportedIncidents()->where('status', IncidentStatus::IN_PROGRESS)->count())
        ->description('Están trabajando en ello')
        ->descriptionIcon(Heroicon::OutlinedClock)
        ->color('primary'),
      Stat::make('Mis Incidencias Resueltas', $user->reportedIncidents()->where('status', IncidentStatus::CLOSED)->count())
        ->description('Incidencias finalizadas')
        ->descriptionIcon(Heroicon::OutlinedHandThumbUp)
        ->color('success'),
    ];
  }
}

