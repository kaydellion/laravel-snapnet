<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
   
    public function index(Request $request)
    {
        // Get the authenticated user's tasks
        $query = Task::where('user_id', Auth::id());

        // Check if status filter exists and apply it
        if ($request->has('status') && in_array($request->status, ['Pending', 'Completed'])) {
            $query->where('status', $request->status);
        }

        // Paginate results
        $tasks = $query->paginate(10);

        return view('tasks.index', compact('tasks'));
    }
    

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
        'due_date' => 'required|date|after:today',
    ]);

    Task::create([
        'user_id' => auth()->id(),
        'title' => $request->title,
        'description' => $request->description,
        'due_date' => $request->due_date,
        'status' => 'Pending',
    ]);

    return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
}

public function update(Request $request, Task $task)
{
    $this->authorize('update', $task);

    $request->validate([
        'title' => 'required|max:255',
        'due_date' => 'required|date|after:today',
    ]);

    $task->update($request->all());

    return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
}

public function destroy(Task $task)
{
    
    $task->delete();
    return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
}

public function markComplete(Task $task)
{

    $task->update(['status' => 'Completed']);
    return redirect()->route('tasks.index')->with('success', 'Task marked as completed.');
}

public function create()
{
    return view('tasks.create');
}

public function edit(Task $task)
{
    // Ensure the logged-in user is the owner of the task
    if ($task->user_id !== auth()->id()) {
        return redirect()->route('tasks.index')->with('error', 'Unauthorized access.');
    }

    return view('tasks.edit', compact('task'));
}


}
