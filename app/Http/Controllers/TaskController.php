<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Services\GamificationService;


class TaskController extends Controller
{
    


    public function index1(Request $request)
{
    $userId = auth()->id();

    $date = $request->query('date', Carbon::today()->toDateString()); 
    // Group tasks dynamically by priority
    $tasksByPriority = Task::where('user_id', $userId)->whereDate('created_at', $date) // Task is a modal, bcos of eloquent, it knows/finds table called tasks
    ->orderByRaw("FIELD(priority, 'high', 'medium', 'low')") // order by priority, high to low
    ->get()
    ->groupBy('priority'); // make them a key value pair, key is priority

    // after get() (eloquent), already from high to low
    // $tasks = collect([ Task{id:1, ...}, Task{id:2, ...}, Task{id:3, ...}]);

    //before get(sql) returns id => 1, ...


    // 'high' => [ Task 1, Task 5,]

    
   

    return view('home', compact('tasksByPriority'));
}

public function index(Request $request)
{
    $userId = auth()->id();
    
    // Get query parameters from the form in blade, also in the url u can see, i think these are default, if havent runform
    //http://127.0.0.1:8000/tasks?date=2026-01-12&sort=created_at&status=&group_by=priority
    $date = $request->query('date', Carbon::today()->toDateString());
    $sort = $request->query('sort', 'created_at');
    $statusFilter = $request->query('status'); // thats why here no default for filter, as all status is not a enum of status
    $groupBy = $request->query('group_by', 'priority');
    $search = $request->query('search');

    // Base query: tasks for this user and selected date
    $query = Task::where('user_id', $userId)
                 ->whereDate('created_at', $date);

    // Filter by status
    if ($statusFilter) { //if not null, run this
        $query->where('status', $statusFilter);
    }

     // Search by title
    if ($search) {
        $query->where('title', 'like', "%{$search}%");
    }

    // Sort
    switch ($sort) {
        case 'priority':
            $query->orderByRaw("FIELD(priority,'high','medium','low')");
            break;
        case 'due_date':
            $query->orderBy('due_date', 'asc');
            break;
        case 'status':
            $query->orderBy('status', 'asc');
            break;
        default:
            $query->orderBy('created_at','asc');
            break;
    }

    $tasks = $query->get();

    // Dynamic grouping
   
    if ($groupBy === 'priority' || $groupBy === 'status' || $groupBy === 'category') {
        $tasksGrouped = $tasks->groupBy($groupBy);
    } elseif ($groupBy === 'due_date') {
        $tasksGrouped = $tasks->groupBy(function($task){
            return \Carbon\Carbon::parse($task->due_date)->toDateString();
        });
    } else {
        $tasksGrouped = $tasks->groupBy('priority'); // fallback
    }

    return view('home', compact('tasksGrouped', 'groupBy', 'date', 'sort', 'statusFilter'));
}

   public function tasksByCategory(){
    $userId = auth()->id();
    $tasksByCategory = Task::where('user_id', $userId)
    ->orderByRaw("FIELD(category, 'chores','exercise','study','assignment')")
    ->get()->groupBy('category');

    return view('', compact('$taskByCategory'));


   }

  
    // create new task
   public function store(Request $request)
{
    $validated = $request->validate([ // ->all();
        'title' => 'required|string|max:255', //key == name in form
        'description' => 'nullable|string',
        'type' => 'required|in:chores,exercise,study,assignment',
        'priority' => 'required|in:low,medium,high',
        'status' => 'required|in:pending,in_progress,completed',
        'assignee' => 'nullable|string|max:255',
        'due_date' => 'nullable|date',
        'points' => 'nullable|integer|min:0',
    ]);

    $validated['user_id'] = auth()->id();

    Task::create($validated);

    return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
}




    // Update task
    public function update(Request $request, $id, GamificationService $gamification)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:chores,exercise,study,assignment',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed',
            'assignee' => 'nullable|string|max:255',
            'due_date' => 'nullable|date',
            'points' => 'nullable|integer|min:0',
        ]);

        $task = Task::findOrFail($id);
        $oldStatus = $task->status;

        $task->update($validated);

        if ($oldStatus !== 'completed' && $task->status === 'completed') {
            $gamification->awardForTaskCompletion(auth()->user(), $task);
        }

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    // Delete task
    public function destroy($id)
    { 
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
    

}
