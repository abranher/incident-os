<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\Permission as PermissionEnum;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    foreach (PermissionEnum::cases() as $permission) {
      Permission::create(['name' => $permission->value]);
    }

    $superAdmin = Role::create(['name' => 'super_admin']);

    User::create([
      'name' => 'Administrador',
      'email' => 'admin@example.com',
      'password' => 'password',
      'email_verified_at' => now(),
    ])->assignRole($superAdmin);
  }
}

