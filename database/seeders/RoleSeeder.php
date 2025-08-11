<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::updateOrCreate(
            ['name' => RoleEnum::MANAGER->value],
            ['name' => RoleEnum::MANAGER->value]
        );

        Role::updateOrCreate(
            ['name' => RoleEnum::USER->value],
            ['name' => RoleEnum::USER->value]
        );
    }
}
