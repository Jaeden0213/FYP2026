<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\StoreItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       

         $this->call([ // so i don need to specify the specific seeder class
        AdminUserSeeder::class,
        StoreItemSeeder::class,
    ]);

    }
}
