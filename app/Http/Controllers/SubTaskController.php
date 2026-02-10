<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subtask;
use App\Models\Task;

class SubTaskController extends Controller
{

// create new subtask
   public function store(Request $request, $id, \App\Services\AiTaskService $aiService)
{          
    $validated = $request->validate([ // ->all();
        'title' => 'required|string|max:255', //key == name in form
        'description' => 'nullable|string',
        'status' => 'required|in:pending,in_progress,completed',
        'due_date' => 'nullable|date',
        'points' => 'nullable|integer|min:0',
    ]);

    $validated['task_id'] = $id;

    //call ai
     // $AIGeneratedPoints = $aiService->generatePointsViaAI($request);

    
    //and points 

    //$validated['points'] = $AIGeneratedPoints;

    

    SubTask::create($validated);

    $this->balancePoints($id);

    return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
}
    

    public function update(Request $request, $id, $taskId)
    {

    $subtask = SubTask::findorfail($id);
    $task = Task::findOrFail($taskId);

     $subtask->update($request->all());


    // Get all its subtasks
    $subtasks = $task->subtasks;

    
    // check if all subtasks are comp
    $allFinished = $subtasks->every(function ($subtask) { //every() returns true only when everyone meets criteria 
        return $subtask->status === 'completed'; // criteria
    });

    // if all comp, comp the task
    if ($allFinished) {
        $task->update(['status' => 'completed']);
    }


    
    $notAllFinished = $subtasks->every(function ($subtask) { //every() returns true only when everyone meets criteria 
        return $subtask->status === 'completed'; // criteria
    });

    if (!$notAllFinished) {
        $task->update(['status' => 'in_progress']);
    }



   

    return redirect()->route('tasks.index')->with('success', 'Subtask updated successfully!');

    }

    public function destroy($id){

    
    $subtask = SubTask::findorfail($id);
    $parentTaskId = $subtask->task_id;

    $subtask->delete();

    $this->balancePoints($parentTaskId);

    return redirect()->route('tasks.index')->with('success', 'Subtask updated successfully!');

    }

    public function balancePoints($taskId)
{
    $task = Task::with('subtasks')->find($taskId);
    $count = $task->subtasks->count();

    if ($count > 0) {
        // Simple division
        $pointsPerSubtask = $task->points / $count;

        // Update all subtasks for this task at once
        $task->subtasks()->update(['points' => $pointsPerSubtask]);
    }
}
}
