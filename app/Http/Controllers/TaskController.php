<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // GET /office/{task_manager}/{task}
    public function show(TaskManager $task_manager, Task $task)
    {
        if ($task->task_manager_id != $task_manager->id) {
            abort(404);
        }

        if (Auth::id() != $task_manager->user_id) {
            abort(403, message: 'yleo');
        }

        return view('office.task_managers.tasks.show', compact('task_manager', 'task'));
    }

    public function create(TaskManager $task_manager)
    {
        if (Auth::id() != $task_manager->user_id) {
            abort(403, message: 'yleo');
        }

        return view('office.task_managers.create', compact('task_manager'));
    }

    public function store(Request $request, TaskManager $task_manager)
    {
        if (Auth::id() != $task_manager->user_id) {
            abort(403, message: 'yleo');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'daily_target' => ['required', 'integer', 'min:1'],
            'unit_type' => ['required', 'string', 'max:50'],
            'start_date' => ['required', 'date'],
            'is_active' => ['required', 'boolean'],
        ]);

        $task_manager->tasks()->create($validated);

        return redirect()->route('office.task_managers.show', $task_manager);
    }
}
