<?php

namespace App\Jobs;

use App\Models\Task;
use App\Models\User;
use App\Services\GamificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AwardTaskCompletion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $userId, public int $taskId) {}

    public function handle(GamificationService $gamification): void
    {
        $user = User::find($this->userId);
        $task = Task::find($this->taskId);

        if (!$user || !$task) return;

        $gamification->awardForTaskCompletion($user, $task);
    }
}

