<?php

namespace App\Filament\Resources\Roles\Pages;

use App\Enums\Role as RoleEnum;
use App\Filament\Resources\Roles\RoleResource;
use Filament\Resources\Pages\ViewRecord;

class ViewRole extends ViewRecord
{
  protected static string $resource = RoleResource::class;

  public function getTitle(): string
  {
    return RoleEnum::tryFrom($this->record->name)?->getLabel() ?? $this->record->name;
  }
}

