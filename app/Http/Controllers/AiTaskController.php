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

        

  return response()->json(['status' => 'processing']);
}

    public function subTaskPoints($id){

    $task = Task::findOrFail($id);

    ProcessSubtaskPoints::dispatch($task);

   
    }

}