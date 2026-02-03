<?php

namespace App\Providers;

use App\Enums\Role as RoleEnum;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    Gate::before(function ($user, $ability) {
      return $user->hasRole(RoleEnum::SUPER_ADMIN->value) ? true : null;
    });

    TextColumn::configureUsing(function (TextColumn $column) {
      $column->timezone('America/Caracas');
    });
  }
}

