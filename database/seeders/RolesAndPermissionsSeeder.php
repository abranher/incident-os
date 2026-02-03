<?php

namespace Database\Seeders;

use App\Enums\Permission as PermissionEnum;
use App\Enums\Role as RoleEnum;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    foreach (PermissionEnum::cases() as $permission) {
      Permission::firstOrCreate(['name' => $permission->value]);
    }

    $superAdmin = Role::firstOrCreate(['name' => RoleEnum::SUPER_ADMIN->value]);
    $superAdmin->syncPermissions(Permission::all());

    $moderator = Role::firstOrCreate(['name' => RoleEnum::MODERATOR->value]);
    $moderator->syncPermissions([
      PermissionEnum::VIEW_ANY_USER->value,
      PermissionEnum::VIEW_USER->value,
      PermissionEnum::UPDATE_USER->value,
      PermissionEnum::VIEW_ANY_ACTIVITY_LOG->value,
    ]);

    $employee = Role::firstOrCreate(['name' => RoleEnum::EMPLOYEE->value]);
    $employee->syncPermissions([
      PermissionEnum::VIEW_ANY_USER->value,
      PermissionEnum::VIEW_USER->value,
    ]);
  }
}

