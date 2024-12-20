<?php

namespace Database\Seeders;

use App\Enums\AppConst\PermissionEnum;
use App\Enums\AppConst\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::firstOrCreate(['name' => 'users.list', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'users.create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'users.update', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'users.show',  'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'users.delete', 'guard_name' => 'web']);

        Permission::firstOrCreate(['name' => 'permissions.list', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'permissions.create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'permissions.update', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'permissions.show',  'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'permissions.delete', 'guard_name' => 'web']);

        Permission::firstOrCreate(['name' => 'imports.list', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'imports.create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'imports.update', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'imports.show',  'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'imports.delete', 'guard_name' => 'web']);

        Permission::firstOrCreate(['name' => PermissionEnum::UserManagement->value, 'guard_name' => 'web']);

        $user = Role::firstOrCreate([
            'name' => RoleEnum::User->value,
            'guard_name' => 'web',
        ]);

        $admin = Role::firstOrCreate([
            'name' => RoleEnum::Admin->value,
            'guard_name' => 'web',
        ]);


        $admin->syncPermissions([
            'users.list',
            'users.create',
            'users.update',
            'users.show',
            'users.delete',
            'permissions.list',
            'permissions.create',
            'permissions.update',
            'permissions.show',
            'permissions.delete',
            'imports.list',
            'imports.create',
            'imports.update',
            'imports.show',
            'imports.delete',
        ]);
    }
}
