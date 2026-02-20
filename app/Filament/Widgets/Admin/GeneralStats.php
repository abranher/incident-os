<?php

namespace App\Filament\Widgets\Admin;

use App\Enums\IncidentStatus;
use App\Enums\Role as RoleEnum;
use App\Models\Department;
use App\Models\Incident;
use App\Models\User;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class GeneralStats extends StatsOverviewWidget
{
  protected ?string $heading = 'Resumen Global';

  protected static ?int $sort = 1;

  protected array|int|null $columns = 2;

  public static function canView(): bool
  {
    return Auth::user()->hasRole(RoleEnum::SUPER_ADMIN->value);
  }

  protected function getStats(): array
  {
    return [
      Stat::make('Total Incidencias', Incident::count())
        ->description('Registradas en el sistema')
        ->descriptionIcon(Heroicon::OutlinedDocumentText)
        ->color('primary'),
      Stat::make('Incidencias Abiertas', Incident::where('status', IncidentStatus::NEW)->count())
        ->description('Pendientes de atención')
        ->descriptionIcon(Heroicon::OutlinedExclamationCircle)
        ->color('danger'),
      Stat::make('Departamentos', Department::count())
        ->description('Áreas operativas')
        ->descriptionIcon(Heroicon::OutlinedBuildingOffice),
      Stat::make('Usuarios', User::count())
        ->description('Total registrados')
        ->descriptionIcon(Heroicon::OutlinedUsers),
    ];
  }
}

