<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StoreItem;

class StoreItemSeeder extends Seeder
{
    public function run(): void
    {
        StoreItem::insert([
            [
                'name' => 'Starbucks RM10 Voucher',
                'brand' => 'Starbucks',
                'points_cost' => 100,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
                'image_path' => null,
            ],
            [
                'name' => 'Zus Coffee RM5 Voucher',
                'brand' => 'Zus Coffee',
                'points_cost' => 50,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
                'image_path' => null,
            ],
            [
                'name' => 'GrabFood RM10 Voucher',
                'brand' => 'Grab',
                'points_cost' => 120,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
                'image_path' => null,
            ],
        ]);
    }
}
