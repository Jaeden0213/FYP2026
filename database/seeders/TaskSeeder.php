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
       // DB::table('tasks')->insert([
       //     [
        //        'user_id' => 2,
        //        'title' => 'Study Object Oriented Programming Chapter 1',
       //         'description' => 'Review classes, objects, and inheritance basics.',
        //        'priority' => 'medium',
        //        'category' => 'study',
         //       'status' => 'pending',
        //        'assignee' => null,
        //        'due_date' => Carbon::today()->toDateString(),
        //        'points' => 35,
        //        'start_time' => '16:22:00',
        //        'end_time' => '18:22:00',
         //       'created_at' => Carbon::now(),
        //        'updated_at' => Carbon::now(),
        //    ],
           
       // ]);

        // Define meaningful titles mapped to categories
    $taskTitles = [
        'study' => [
            'Review Object Oriented Programming', 
            'Database Normalization Practice', 
            'Advanced Laravel Middleware Research', 
            'Data Structures and Algorithms'
        ],
        'assignment' => [
            'Finalize FYP Progress Report', 
            'Design UI Wireframes for Dashboard', 
            'Write Documentation for AI Module', 
            'Submit System Architecture Diagram'
        ],
        'chores' => [
            'Organize Workspace', 
            'Backup Project Files', 
            'Update Repository Readme', 
            'Cleanup Database Logs'
        ],
        'exercise' => [
            'Quick Morning Jog', 
            'Evening Stretching Session', 
            'Gym Workout - Upper Body', 
            '15-Minute Yoga Flow'
        ],
    ];

    $priorities = ['low', 'medium', 'high'];
    $timeSlots = [
        ['08:00:00', '09:30:00'],
        ['10:00:00', '12:00:00'],
         ['10:00:00', '11:00:00'],
        ['13:30:00', '15:30:00'],
        ['14:30:00', '16:30:00'],
        ['16:00:00', '17:30:00'],
        ['16:30:00', '17:30:00'],
        ['16:00:00', '18:30:00'],
        ['17:00:00', '18:30:00'],
        ['17:30:00', '18:30:00'],
        ['17:30:00', '19:30:00'],
        ['20:00:00', '21:30:00'],
    ];

    // 1. Loop through your 7-day range (-3 to +3)
foreach (range(-3, 3) as $offset) {
    $date = Carbon::today()->addDays($offset);

    // 2. Pick exactly 4 RANDOM indices from your $timeSlots array
    // This gives you 4 random keys like [0, 3, 5, 11]
    $randomSlotKeys = array_rand($timeSlots, 4);

    // 3. Reset your "Title Deck" for the day
    $tempTitles = $taskTitles;
    foreach ($tempTitles as $key => $titles) { shuffle($tempTitles[$key]); }

    // 4. Loop ONLY through those 4 selected slots
    foreach ($randomSlotKeys as $key) {
        $slot = $timeSlots[$key]; // Get the specific [start, end] time

        // Pick category and title...
        $availableCategories = array_filter($tempTitles, fn($t) => count($t) > 0);
        if (empty($availableCategories)) break;

        $cat = array_rand($availableCategories);
        $title = array_pop($tempTitles[$cat]);

        DB::table('tasks')->insert([
            'user_id'     => 2,
            'title'       => $title,
            'description' => null,
            'priority'    => $priorities[array_rand($priorities)],
            'category'    => $cat,
            'status'      => 'in_progress',
            'due_date'    => $date->toDateString(),
            'points'      => rand(10, 100),
            'start_time'  => $slot[0],
            'end_time'    => $slot[1],
            'created_at'  => $date->copy()->setTimeFromTimeString($slot[0]),
            'updated_at'  => $date->copy()->setTimeFromTimeString($slot[0]),
        ]);
    }
}
}
}

//run use  php artisan db:seed --class=TaskSeeder 