<?php

namespace App\Filament\Widgets;

use App\Enums\Permission as PermissionEnum;
use App\Models\ActivityLog;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class ActivityLogStats extends StatsOverviewWidget
{
  protected ?string $heading = 'Métricas de la Bitácora';

  protected static ?int $sort = 2;

  protected array|int|null $columns = 2;

  public static function canView(): bool
  {
    return Auth::user()->hasPermissionTo(PermissionEnum::VIEW_ACTIVITY_LOG->value);
  }

  protected function getStats(): array
  {
    $stats = ActivityLog::query()
      ->whereDate('created_at', now())
      ->selectRaw('count(*) as total_actions')
      ->selectRaw('count(distinct causer_id) as total_users')
      ->first();

    $totalToday = $stats->total_actions ?? 0;
    $usersToday = $stats->total_users ?? 0;

    return [
      Stat::make('Bitácora: Actividad hoy', $totalToday)
        ->description('Cambios realizados por los usuarios')
        ->descriptionIcon(Heroicon::OutlinedFingerPrint)
        ->color('info'),
      Stat::make('Bitácora: Usuarios activos hoy', $usersToday)
        ->description('Personas que interactuaron con el sistema')
        ->descriptionIcon(Heroicon::OutlinedUserGroup)
        ->color('success'),
    ];
  }
}

