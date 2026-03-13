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
        'name' => 'tester1',
        'email' => 'tester1@example.com',
        'password' => Hash::make('test123'),
        'role' => 'student',
        'status' => 'active',
        'email_verified_at' => now(),
    ]);

   // User::create([
   //     'name' => 'Jae Den',
   //     'email' => 'chanjaeden113@gmail.com',
    //    'password' => Hash::make('Jaeden13!'),
   //     'role' => 'student',
   //     'status' => 'active',
   //     'email_verified_at' => now(),
   // ]);


   for ($i = 4; $i <= 14; $i++) {
    User::create([
     'name' => 'Tester' . $i,
        'email' => "tester{$i}@example.com", // Unique email for each
        'password' => Hash::make('test123'),
        'role' => 'student',
        'status' => 'active',
        'email_verified_at' => now(),
        // This picks a random number of days between 1 and 120 (approx 4 months)
        'created_at' => now()->subDays(rand(1, 120)), 
        'updated_at' => now()->subDays(rand(1, 120)),
    ]);
}

    

    }
}
