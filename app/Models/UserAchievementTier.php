<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAchievementTier extends Model
{
    protected $fillable = [
        'user_id',
        'achievement_tier_id',
        'unlocked_at',
        'is_claimed',
        'claimed_at',
        'context',
    ];

    protected $casts = [
        'unlocked_at' => 'datetime',
        'claimed_at' => 'datetime',
        'is_claimed' => 'boolean',
        'context' => 'array',
    ];

    public function tier()
    {
        return $this->belongsTo(AchievementTier::class, 'achievement_tier_id');
    }
}