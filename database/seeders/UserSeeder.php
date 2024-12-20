<?php

namespace Database\Seeders;

use App\Enums\AppConst\PermissionEnum;
use App\Enums\AppConst\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = $this->getUsers();

        foreach ($users as $roleName => $roleUsers) {
            $role = Role::where('name', $roleName)->first();
            
            foreach ($roleUsers as $userData) {
                $user = User::where('email', $userData['email'])->first();
                if (!$user) {
                    $user = User::create($userData);
                    $user->assignRole($role);
                    if($roleName === RoleEnum::Admin->value) {
                        $user->givePermissionTo(PermissionEnum::UserManagement->value);
                    }
                }
            }
        }
    }

    private function getUsers(): array
    {
        return [
            ########## Super admin
            RoleEnum::Admin->value => [[
                'first_name' => 'User',
                'last_name' => 'Admin',
                'email' => 'useradmin@gmail.com',
                'password' => Hash::make('jGT>2g7B,4Sb_:E)'),
            ],],
            ########## User
            RoleEnum::User->value => [[
                'first_name' => 'User',
                'last_name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('QC2aJq$XLKFbz#EH'),
            ]],
        ];
    }
}
