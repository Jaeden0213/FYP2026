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

class ProcessAiSubtasks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Task $task) {}

    public function handle(): void
    {
        // MOVE YOUR SLOW AI CODE HERE
        $response = AiTaskService::generateSubtasks($this->task, $this->task->subtasks);
  
        if (isset($response['subtasks'])) {
            $this->task->subtasks()->delete();
            
            foreach ($response['subtasks'] as $item) { 
                Subtask::create([
                    'task_id'     => $this->task->id,
                    'title'       => $item['title'] ?? 'Untitled',
                    'description' => $item['description'] ?? null,
                    'priority'    => $item['priority'] ?? 'medium',
                    'status'      => 'in_progress',
                    'points'      => $this->task->points * ($item['weight'] ?? 0),
                ]);
            }
        }
    }
}