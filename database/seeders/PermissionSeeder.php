<?php

namespace Database\Seeders;

use App\Enums\Permission\PermissionAction;
use App\Enums\Permission\PermissionResource;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect(PermissionResource::getValues())
            ->crossJoin(PermissionAction::getValues())
            ->map(function ($set) {
                return implode('.', $set);
            })->each(function ($permission) {
                Permission::create(['name' => $permission]);
            });
    }
}
