<?php

namespace Database\Seeders;

use App\Enums\User\UserRole;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createSupeAdminRole();

        collect(UserRole::cases())->each(function (UserRole $userRole) {
            if ($userRole->value !== UserRole::SUPER_ADMIN->value) {
                $this->createRole($userRole);
            }
        });
    }

    public function createRole(UserRole $roleName, Collection $permissions = null): void
    {
        $newRole = Role::create(['name' => $roleName->value]);

        if ($permissions) {

            $newRole->permissions()->sync($permissions);
        }
    }

    public function createSupeAdminRole(): void
    {
        $permissions = Permission::query()
            ->where('name', 'like', 'agent.%')
            ->orWhere('name', 'like', 'applicant.%')
            ->pluck('id');

        $this->createRole(roleName: UserRole::SUPER_ADMIN, permissions: $permissions);
    }
}
