<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subtask;

class SubTaskController extends Controller
{

// create new task
   public function store(Request $request, $id)
{          
    $validated = $request->validate([ // ->all();
        'title' => 'required|string|max:255', //key == name in form
        'description' => 'nullable|string',
        'status' => 'required|in:pending,in_progress,completed',
        'due_date' => 'nullable|date',
        'points' => 'nullable|integer|min:0',
    ]);

    $validated['task_id'] = $id;

    SubTask::create($validated);

    return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
}
    

    public function update(Request $request, $id)
    {

    $subtask = SubTask::findorfail($id);


    $subtask->update($request->all());

    return redirect()->route('tasks.index')->with('success', 'Subtask updated successfully!');

    }

    public function destroy($id){

    
    $subtask = SubTask::findorfail($id);
    $subtask->delete();

    return redirect()->route('tasks.index')->with('success', 'Subtask updated successfully!');

    }
}
