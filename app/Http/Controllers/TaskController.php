<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // GET /office/{task_manager}/{task}
    public function show(TaskManager $task_manager, Task $task)
    {
        return view('office.task_managers.tasks.show', compact('task_manager', 'task'));
    }

    public function store(Request $request, TaskManager $task_manager)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'due_date' => ['required', 'date'],
            'daily_target' => ['required', 'integer', 'min:1'],
        ]);

        $task_manager->tasks()->create([
            'name' => $validated['name'],
            'due_date' => $validated['due_date'],
            'daily_target' => $validated['daily_target'],
        ]);

        return redirect()->route('office.task_managers.show', $task_manager);
    }
}
