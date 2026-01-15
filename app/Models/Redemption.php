<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redemption extends Model
{
    protected $fillable = [
        'user_id', 'store_item_id', 'points_spent', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(StoreItem::class, 'store_item_id');
    }

    public function storeItem()
    {
        return $this->belongsTo(\App\Models\StoreItem::class);
    }
}
