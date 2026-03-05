<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficeController extends Controller
{
    public function index()
    {
        $taskManagers = Auth::user()
            ->taskManagers()
            ->latest()
            ->get();

        return view('office.index', compact('taskManagers'));
    }

    // GET /office/{task_manager}
    public function showTaskManager(TaskManager $task_manager)
    {
        if (Auth::id() != $task_manager->user_id) {
            abort(403, message: 'yleo');
        }

        $task_manager->load('tasks');

        return view('office.task_managers.show', compact('task_manager'));
    }

    public function create()
    {
        return view('office.create');
    }

    public function edit(TaskManager $task_manager)
    {
        if (Auth::id() != $task_manager->user_id) {
            abort(403);
        }

        return view('office.create', compact('task_manager'));
    }

    public function update(Request $request, TaskManager $task_manager)
    {
        if (Auth::id() != $task_manager->user_id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_date' => ['required', 'date'],
            'is_active' => ['required', 'boolean'],
        ]);

        $task_manager->update($validated);

        return redirect()->route('office.index', $task_manager);
    }

    public function destroy(TaskManager $task_manager)
    {
        if (Auth::id() != $task_manager->user_id) {
            abort(403);
        }

        $task_manager->delete();

        return redirect()->route('office.index');
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
