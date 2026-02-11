<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tasks')->insert([
            [
                'user_id' => 2,
                'title' => 'Study Object Oriented Programming Chapter 1',
                'description' => 'Review classes, objects, and inheritance basics.',
                'priority' => 'medium',
                'category' => 'study', // Changed to study to match title
                'status' => 'pending',
                'assignee' => null,
                'due_date' => Carbon::today()->toDateString(),
                'points' => 67,
                'start_time' => '16:22:00',
                'end_time' => '18:22:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'title' => 'Complete Laravel AI Integration',
                'description' => 'Finalize the AI subtask generation logic.',
                'priority' => 'high',
                'category' => 'assignment',
                'status' => 'in_progress',
                'assignee' => 'Gemini',
                'due_date' => Carbon::today()->addDays(2)->toDateString(),
                'points' => 69,
                'start_time' => '09:00:00',
                'end_time' => '11:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}

//run use  php artisan db:seed --class=TaskSeeder -jordon