<?php

namespace App\Http\Controllers;

use App\Models\TaskManager;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficeController extends Controller
{
    public function index()
    {
        $taskManagers = TaskManager::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('office.index', compact('taskManagers'));
    }

    // GET /office/{task_manager}
    public function showTaskManager(TaskManager $task_manager)
    {
        $task_manager->load('tasks');

        return view('office.task_managers.show', compact('task_manager'));
    }

    // GET /office/{task_manager}/{task}
    public function showTask(TaskManager $task_manager, Task $task)
    {
        // for now: just show the task details page
        return view('office.tasks.show', compact('task_manager', 'task'));
    }

    public function create()
    {
        return view('office.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_date' => ['required', 'date'],
            'is_active' => ['required', 'boolean'],
        ]);

        TaskManager::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'is_active' => $validated['is_active'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('office.index');
    }
}
