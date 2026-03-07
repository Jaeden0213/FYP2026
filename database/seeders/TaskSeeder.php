<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Insert your specific manual tasks first
        DB::table('tasks')->insert([
            [
                'user_id' => 2,
                'title' => 'Study Object Oriented Programming Chapter 1',
                'description' => 'Review classes, objects, and inheritance basics.',
                'priority' => 'medium',
                'category' => 'study',
                'status' => 'pending',
                'assignee' => null,
                'due_date' => Carbon::today()->toDateString(),
                'points' => 35,
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
                'points' => 30,
                'start_time' => '09:00:00',
                'end_time' => '11:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // 2. Setup for the Loop
        $categories = ['study', 'assignment', 'chores', 'exercise'];
        $priorities = ['low', 'medium', 'high'];
        $timeSlots = [
           ['08:00:00', '09:30:00'],
            ['10:00:00', '12:00:00'],
            ['13:30:00', '15:30:00'],
            ['16:00:00', '17:30:00'],
            ['20:00:00', '21:30:00'],
        ];

        // 3. Run the loop for Today and Yesterday
        foreach ([Carbon::today(), Carbon::yesterday()] as $date) {
            foreach ($timeSlots as $index => $slot) {
                $cat = $categories[array_rand($categories)];
                
                DB::table('tasks')->insert([
                    'user_id' => 2,
                    'title' => ucfirst($cat) . " Task " . ($index + 1),
                    'description' => "Automated $cat session for " . $date->format('l'),
                    'priority' => $priorities[array_rand($priorities)],
                    'category' => $cat,
                    'status' => 'pending',
                    'assignee' => null,
                    'due_date' => $date->toDateString(),
                    'points' => rand(20, 50), // Randomize points too!
                    'start_time' => $slot[0],
                    'end_time' => $slot[1],
                    'created_at' => $date->copy()->setTimeFromTimeString($slot[0]),
                    'updated_at' => $date->copy()->setTimeFromTimeString($slot[0]),
                ]);
            }
        }
    }
}

//run use  php artisan db:seed --class=TaskSeeder -jordon -ok