<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Subtask;
use App\Services\AiTaskService; 

class AiTaskController extends Controller
{
    public function breakdownTask(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id'
        ]);

        $task = Task::find($request->task_id);

        $subtasks = AiTaskService::generateSubtasks($task);

        

        //foreach ($subtasks as $title) { //loop tru every subtask
       //     Subtask::create([
       //         'task_id' => $task->id, // bcos task_id needs to be the id of the parent task, so cannot be $title->id 
       //         'title' => $title 
       //     ]);
      //  }

        

        return response()->json([ // convert array/obj to json
          'subtasks' => $subtasks // now this is an array.  yep, bcos browser can understand json only
        ]); // laravel understands objects and array, thats why need reload, its going to server first
    
       //return $subtasks;
        //return response()->json($subtasks);
    }
}
// only a return response()->json will give json its headers, as after a controller its http liao
