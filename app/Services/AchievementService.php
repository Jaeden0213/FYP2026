<?php

namespace App\Services;

use App\Models\AchievementTier;
use App\Models\UserAchievementTier;
use App\Models\Task;
use App\Models\Point;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AchievementService
{
    public function metricValue(int $userId, string $metricKey): int
    {
        return match ($metricKey) {
            'tasks_completed_total' => Task::where('user_id', $userId)
                ->where('status', 'completed')
                ->count(),

            'tasks_completed_study' => Task::where('user_id', $userId)
                ->where('status', 'completed')
                ->where('category', 'study')
                ->count(),

            'tasks_completed_chores' => Task::where('user_id', $userId)
                ->where('status', 'completed')
                ->where('category', 'chores')
                ->count(),

            'tasks_completed_assignment' => Task::where('user_id', $userId)
                ->where('status', 'completed')
                ->where('category', 'assignment')
                ->count(),

            'tasks_completed_exercise' => Task::where('user_id', $userId)
                ->where('status', 'completed')
                ->where('category', 'exercise')
                ->count(),

            default => 0,
        };
    }

    public function checkAndUnlock(int $userId): void
    {
        $tiers = AchievementTier::with('achievement')
            ->whereHas('achievement', fn ($q) => $q->where('is_active', true))
            ->get();

        foreach ($tiers as $tier) {
            $alreadyExists = UserAchievementTier::where('user_id', $userId)
                ->where('achievement_tier_id', $tier->id)
                ->exists();

            if ($alreadyExists) {
                continue;
            }

            $value = $this->metricValue($userId, $tier->metric_key);

            if ($value >= $tier->target_value) {
                UserAchievementTier::create([
                    'user_id' => $userId,
                    'achievement_tier_id' => $tier->id,
                    'unlocked_at' => now(),
                    'is_claimed' => false,
                    'claimed_at' => null,
                    'context' => [
                        'metric_value' => $value,
                    ],
                ]);
            }
        }
    }

    public function claim(int $userId, int $userAchievementTierId): UserAchievementTier
    {
        return DB::transaction(function () use ($userId, $userAchievementTierId) {
            $userAchievement = UserAchievementTier::with('tier.achievement')
                ->where('id', $userAchievementTierId)
                ->where('user_id', $userId)
                ->firstOrFail();

            if ($userAchievement->is_claimed) {
                throw new \Exception('Achievement already claimed.');
            }

            $userAchievement->update([
                'is_claimed' => true,
                'claimed_at' => now(),
            ]);

            $user = User::findOrFail($userId);
            $rewardPoints = (int) $userAchievement->tier->reward_points;

            Point::create([
                'user_id' => $userId,
                'points_value' => $rewardPoints,
                'level' => intdiv($user->totalPoints() + $rewardPoints, 100) + 1,
                'source_type' => 'achievement_claim',
                'description' => 'Points awarded for claiming achievement: '
                    . $userAchievement->tier->achievement->title
                    . ' - '
                    . $userAchievement->tier->tier_name,
            ]);

            return $userAchievement->fresh();
        });
    }
}