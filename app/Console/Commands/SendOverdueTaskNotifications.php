<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskStatusMail;
use App\Models\User;

class SendOverdueTaskNotifications extends Command
{
    protected $signature = 'notify:overdue';
    protected $description = 'Send notification once when a task first becomes overdue';

    public function handle(): int
    {
        $today = Carbon::today(); // due_date is DATE, so compare with today()

        $tasks = Task::query()
            ->whereNotNull('due_date')
            ->where('due_date', '<', $today)
            ->whereNull('overdue_notified_at')                 // ✅ only once
            ->whereIn('status', ['pending', 'in_progress'])    // ✅ your statuses
            ->get();

        foreach ($tasks as $task) {

            // 1) Save in-app notification (DB)
            Notification::create([
                'message' => 'Task overdue: ' . $task->title,
                'notification_type' => 'task_overdue',
                'sent_status' => false,        // unread
                'scheduled_time' => null,
                'user_id' => $task->user_id,
                'task_id' => $task->id,
            ]);

            // 2) Send email
            $user = User::find($task->user_id);

            if ($user && $user->email) {
                Mail::to($user->email)->send(
                    new TaskStatusMail(
                        $task,
                        'Task Overdue: ' . $task->title,
                        'Your task is overdue. Please complete it as soon as possible.'
                    )
                );
            }

            // 3) Mark as already notified (so it won't spam)
            $task->overdue_notified_at = Carbon::now();
            $task->save();
        }


        $this->info("Overdue notifications sent: " . $tasks->count());
        return Command::SUCCESS;
    }
}
