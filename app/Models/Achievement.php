<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'category',
        'icon',
        'is_active',
    ];

    public function tiers()
    {
        return $this->hasMany(AchievementTier::class)->orderBy('tier_order');
    }
}