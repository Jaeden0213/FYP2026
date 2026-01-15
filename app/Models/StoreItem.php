<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreItem extends Model
{
    protected $fillable = [
        'name', 'brand', 'points_cost', 'stock', 'is_active', 'description'
    ];

    public function redemptions()
    {
        return $this->hasMany(Redemption::class);
    }
}
