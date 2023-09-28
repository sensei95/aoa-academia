<?php

namespace Database\Seeders;

use App\Enums\User\UserRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createSuperAdminUser();
    }

    public function createSuperAdminUser(): void
    {
        User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'super_admin@dev.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ])->roles()->sync(Role::where('name', UserRole::SUPER_ADMIN->value)->first());
    }
}
