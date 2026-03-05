<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function show(TaskManager $task_manager, Task $task)
    {
        if ($task->task_manager_id !== $task_manager->id) {
            abort(404);
        }

        if ($task_manager->user_id !== Auth::id()) {
            abort(403);
        }

        $task->load('entries');

        return view('office.task_managers.tasks.show', compact('task_manager', 'task'));
    }

    public function create(TaskManager $task_manager)
    {
        if ($task_manager->user_id !== Auth::id()) {
            abort(403);
        }

        return view('office.task_managers.create', compact('task_manager'));
    }

    public function edit(TaskManager $task_manager, Task $task)
    {
        if ($task->task_manager_id !== $task_manager->id) {
            abort(404);
        }

        if ($task_manager->user_id !== Auth::id()) {
            abort(403);
        }

        return view('office.task_managers.create', compact('task_manager', 'task'));
    }

    public function update(Request $request, TaskManager $task_manager, Task $task)
    {
        if ($task->task_manager_id !== $task_manager->id) {
            abort(404);
        }

        if ($task_manager->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'daily_target' => ['required', 'integer', 'min:1'],
            'unit_type' => ['required', 'string', 'max:50'],
            'is_active' => ['required', 'boolean'],
        ]);

        $task->update($validated);

        return redirect()->route('office.task_managers.show', [$task_manager, $task]);
    }

    public function destroy(TaskManager $task_manager, Task $task)
    {
        if ($task->task_manager_id !== $task_manager->id) {
            abort(404);
        }

        if ($task_manager->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('office.task_managers.show', $task_manager);
    }

    public function store(Request $request, TaskManager $task_manager)
    {
        if ($task_manager->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'daily_target' => ['required', 'integer', 'min:1'],
            'unit_type' => ['required', 'string', 'max:50'],
            'is_active' => ['required', 'boolean'],
        ]);

        $task_manager->tasks()->create($validated);

        return redirect()->route('office.task_managers.show', $task_manager);
    }
}
