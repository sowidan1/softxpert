<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ManagerSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', RoleEnum::MANAGER->value)
            ->firstOrFail();

        $user = User::updateOrCreate(
            ['email' => 'manager11@gmail.com'],
            [
                'name' => 'manager',
                'email' => 'manager11@gmail.com',
                'password' => Hash::make('password'),
            ]
        );

        $user->assignRole($adminRole);
    }
}
