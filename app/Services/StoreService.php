<?php

namespace App\Services;

use App\Models\Redemption;
use App\Models\Point;
use App\Models\StoreItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StoreService
{
    public function redeem(User $user, StoreItem $item): void
{
    DB::transaction(function () use ($user, $item) {

        if (!$item->is_active) {
            throw new \RuntimeException('Item unavailable.');
        }

        if ($item->stock !== null && $item->stock <= 0) {
            throw new \RuntimeException('Out of stock.');
        }

        // IMPORTANT: recompute inside transaction
        $currentPoints = (int) $user->points()->sum('points_value');

        if ($currentPoints < $item->points_cost) {
            throw new \RuntimeException('Not enough points.');
        }

        // Inventory record
        Redemption::create([
            'user_id' => $user->id,
            'store_item_id' => $item->id,
            'points_spent' => $item->points_cost,
            'status' => 'owned', // or 'pending'
        ]);

        // Deduct points (negative record)
        Point::create([
        'user_id' => $user->id,
        'points_value' => -$item->points_cost,
        'level' => intdiv(($user->totalPoints() - $item->points_cost), 100) + 1,
        'source_type' => 'store_redeem',
        'description' => 'Redeemed: ' . $item->name,
    ]);


        // Optional: reduce stock
        if ($item->stock !== null) {
            $item->decrement('stock');
        }
    });
}

}
