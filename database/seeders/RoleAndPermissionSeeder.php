<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            Permission::updateOrCreate(
                ['name' => PermissionEnum::CREATE_TASKS->value],
                ['name' => PermissionEnum::CREATE_TASKS->value]
            ),
            Permission::updateOrCreate(
                ['name' => PermissionEnum::UPDATE_TASKS->value],
                ['name' => PermissionEnum::UPDATE_TASKS->value]
            ),
            Permission::updateOrCreate(
                ['name' => PermissionEnum::ASSIGN_TASKS->value],
                ['name' => PermissionEnum::ASSIGN_TASKS->value]
            ),
            Permission::updateOrCreate(
                ['name' => PermissionEnum::VIEW_OWN_TASKS->value],
                ['name' => PermissionEnum::VIEW_OWN_TASKS->value]
            ),
            Permission::updateOrCreate(
                ['name' => PermissionEnum::UPDATE_TASK_STATUS->value],
                ['name' => PermissionEnum::UPDATE_TASK_STATUS->value]
            ),
        ];

        $managerRole = Role::updateOrCreate(
            ['name' => RoleEnum::MANAGER->value],
            ['name' => RoleEnum::MANAGER->value]
        );

        $userRole = Role::updateOrCreate(
            ['name' => RoleEnum::USER->value],
            ['name' => RoleEnum::USER->value]
        );

        $managerRole->syncPermissions([
            PermissionEnum::CREATE_TASKS->value,
            PermissionEnum::UPDATE_TASKS->value,
            PermissionEnum::ASSIGN_TASKS->value,
        ]);

        $userRole->syncPermissions([
            PermissionEnum::VIEW_OWN_TASKS->value,
            PermissionEnum::UPDATE_TASK_STATUS->value,
        ]);
    }
}
