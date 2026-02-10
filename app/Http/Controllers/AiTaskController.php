<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Subtask;
use App\Services\AiTaskService; 

class AiTaskController extends Controller
{
    public function breakdownTask($id)
    {
       
        $task = Task::findOrFail($id);

       

        $subtasks = AiTaskService::generateSubtasks($task);
      

        

        if (isset($subtasks['subtasks'])) {
         foreach ($subtasks['subtasks'] as $item) { 
        Subtask::create([
            'task_id'     => $task->id,
            'title'       => $item['title'] ?? 'Untitled Subtask',
            'description' => $item['description'] ?? null,
            'priority'    => $item['priority'] ?? 'medium',
            'status'    => 'in_progress',
            'points'   => $task->points * $item['weight'] ?? 0,
        ]);
    }
    

    //$task->update($totalPoints);


}

        

   
    
      // return $subtasks;
      return redirect()->route('tasks.index')
                         ->with('success', '✨ AI successfully broke down "' . $task->title . '" into subtasks!');
        
    }

    


}
// only a return response()->json will give json its headers, as after a controller its http liao
