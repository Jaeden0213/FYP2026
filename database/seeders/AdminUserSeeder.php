<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
        public function run(): void
        {
        User::create([
        'name' => 'Admin1',
        'email' => 'admin1@example.com',
        'password' => Hash::make('admin123'),
        'role' => 'admin',
        'status' => 'active',
        'email_verified_at' => now(),
    ]);

    User::create([
        'name' => 'Jae Den',
        'email' => 'chanjaeden113@gmail.com',
        'password' => Hash::make('Jaeden13!'),
        'role' => 'student',
        'status' => 'active',
        'email_verified_at' => now(),
    ]);

    }
}
