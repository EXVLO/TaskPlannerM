<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use carbon\carbon;

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

        // Check if the manager is active
        if (! $task_manager->is_active) {
            // Redirect back with a message; adjust route as needed
            return redirect()->route('office.index')
                ->with('error', 'This task manager is not active right now.');
        }

        $task_manager->load('tasks');

        foreach ($task_manager->tasks as $task) {
            // Sum actual_value for entries in the last 7 and 30 days
            $last7Total = $task->entries()
                ->whereDate('entry_date', '>=', Carbon::now()->subDays(6)->toDateString())
                ->sum('actual_value');
            $last30Total = $task->entries()
                ->whereDate('entry_date', '>=', Carbon::now()->subDays(29)->toDateString())
                ->sum('actual_value');

            // Compute percentage of the target achieved (clamp to 100%)
            $task->progress7_percent = $task->daily_target
                ? min(100, ($last7Total / ($task->daily_target * 7)) * 100)
                : 0;
            $task->progress30_percent = $task->daily_target
                ? min(100, ($last30Total / ($task->daily_target * 30)) * 100)
                : 0;
        }

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

        return redirect()
            ->route('office.index')
            ->with('success', 'Task manager updated successfully.');
    }

    public function destroy(TaskManager $task_manager)
    {
        if (Auth::id() != $task_manager->user_id) {
            abort(403);
        }

        $task_manager->delete();

        return redirect()
            ->route('office.index')
            ->with('success', 'Task manager deleted successfully.');
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

        return redirect()
            ->route('office.index')
            ->with('success', 'Task manager created successfully.');
    }
}
