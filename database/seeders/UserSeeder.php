<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', RoleEnum::USER->value)
            ->firstOrFail();

        $user = User::updateOrCreate(
            ['email' => 'user11@gmail.com'],
            [
                'name' => 'user',
                'email' => 'user11@gmail.com',
                'password' => Hash::make('password'),
            ]
        );

        $user->assignRole($adminRole);
    }
}
