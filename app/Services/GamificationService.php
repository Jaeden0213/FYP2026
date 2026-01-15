<?php

namespace App\Services;

use App\Models\Point;
use App\Models\Task;
use App\Models\User;

class GamificationService
{
    public function awardForTaskCompletion(User $user, Task $task): void
    {
        $points = match ($task->priority) {
            'high' => 30,
            'medium' => 20,
            'low' => 10,
            default => 10,
        };

        Point::create([
            'user_id' => $user->id,
            'points_value' => $points,
            'level' => intdiv($user->totalPoints() + $points, 100) + 1,
            'source_type' => 'task_completion',
            'description' => 'Points awarded for completing task: ' . $task->title,
        ]);
    }
}
