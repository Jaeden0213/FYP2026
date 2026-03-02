<?php

namespace App\Jobs;

use App\Models\Task;
use App\Models\Subtask;
use App\Services\AiTaskService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessSubtaskPoints implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Task $task) {}

    public function handle(): void
    {
        // 1. Get the current subtasks from the DB
        $subtasks = $this->task->subtasks;

        // 2. Ask AI: "Here are 5 subtasks. How should I split 100 points between them?"
        // We pass the existing titles so the AI knows what it's looking at
        $response = AiTaskService::generateSubTaskPointsViaAI($this->task, $subtasks);

       $aiResults = collect($response)->keyBy('id'); // keys = subtask IDs

        foreach ($subtasks as $subtask) {
        $newPoints = (int) ($aiResults[$subtask->id]['points'] ?? 0);

        $subtask->update([
            'points' => $newPoints
        ]);
}
    }
}