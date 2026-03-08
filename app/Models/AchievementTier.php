<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AchievementTier extends Model
{
    protected $fillable = [
        'achievement_id',
        'tier',
        'tier_order',
        'metric_key',
        'operator',
        'target_value',
        'reward_points',
        'reward_title',
    ];

    public function achievement()
    {
        return $this->belongsTo(Achievement::class);
    }

    public function userAchievements()
    {
        return $this->hasMany(UserAchievementTier::class, 'achievement_tier_id');
    }
}