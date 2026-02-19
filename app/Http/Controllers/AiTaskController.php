<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Subtask;
use App\Services\AiTaskService; 
use App\Jobs\ProcessAiSubtasks;

class AiTaskController extends Controller
{
    public function breakdownTask($id)
    {
        $task = Task::findOrFail($id);

        // Dispatch the job to the database queue
         ProcessAiSubtasks::dispatch($task);

        //$existingSubtasks = $task->subtasks;

        //$subtasks = AiTaskService::generateSubtasks($task, $existingSubtasks);
  
        //if (isset($subtasks['subtasks'])) {

        //$task->subtasks()->delete();
        
        // foreach ($subtasks['subtasks'] as $item) { 
       // Subtask::create([
       //     'task_id'     => $task->id,
       //     'title'       => $item['title'] ?? 'Untitled Subtask',
       //     'description' => $item['description'] ?? null,
        //    'priority'    => $item['priority'] ?? 'medium',
       //     'status'    => 'in_progress',
       //     'points'   => $task->points * $item['weight'] ?? 0,
       // ]);
    
    


   
    //return redirect()->route('tasks.index')
   //                      ->with('success', '✨ AI successfully broke down "' . $task->title . '" into subtasks!');
        
   // }

  return response()->json(['status' => 'processing']);

    


}
// only a return response()->json will give json its headers, as after a controller its http liao
}