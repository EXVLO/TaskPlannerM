<?php

namespace App\Http\Controllers;

use App\Models\TaskManager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficeController extends Controller
{
    public function index()
    {
        // load managers with tasks and entries in one query
        $taskManagers = Auth::user()->taskManagers()
            ->with(['tasks.entries'])
            ->get();

        foreach ($taskManagers as $manager) {
            $sumActual7 = $sumTarget7 = 0;
            $sumActual30 = $sumTarget30 = 0;
            $today = Carbon::today();
            $managerStart = Carbon::parse($manager->start_date)->startOfDay();
            $windowStart7 = $today->copy()->subDays(6);
            $windowStart30 = $today->copy()->subDays(29);
            $effectiveStart7 = $windowStart7->greaterThan($managerStart) ? $windowStart7 : $managerStart;
            $effectiveStart30 = $windowStart30->greaterThan($managerStart) ? $windowStart30 : $managerStart;
            $activeDays7 = $effectiveStart7->greaterThan($today) ? 0 : $effectiveStart7->diffInDays($today) + 1;
            $activeDays30 = $effectiveStart30->greaterThan($today) ? 0 : $effectiveStart30->diffInDays($today) + 1;

            foreach ($manager->tasks->where('is_active', true) as $task) {
                // sum actual values for this task over the active manager window
                $actual7 = $task->entries
                    ->filter(fn ($entry) => $entry->entry_date->betweenIncluded($effectiveStart7, $today))
                    ->sum('actual_value');
                $actual30 = $task->entries
                    ->filter(fn ($entry) => $entry->entry_date->betweenIncluded($effectiveStart30, $today))
                    ->sum('actual_value');

                $sumActual7 += $actual7;
                $sumActual30 += $actual30;

                // target = daily_target × active days in each window since manager start
                $sumTarget7 += $task->daily_target * $activeDays7;
                $sumTarget30 += $task->daily_target * $activeDays30;
            }

            // compute percentage for the manager (cap at 100 %)
            $manager->progress7_percent = $sumTarget7 > 0 ? min(100, ($sumActual7 / $sumTarget7) * 100) : 0;
            $manager->progress30_percent = $sumTarget30 > 0 ? min(100, ($sumActual30 / $sumTarget30) * 100) : 0;
        }

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
            return redirect()->route('office.index')
                ->with('error', 'This task manager is not active right now.');
        }

        $task_manager->load('tasks.entries');
        $today = Carbon::today();
        $managerStart = Carbon::parse($task_manager->start_date)->startOfDay();
        $windowStart7 = $today->copy()->subDays(6);
        $windowStart30 = $today->copy()->subDays(29);
        $effectiveStart7 = $windowStart7->greaterThan($managerStart) ? $windowStart7 : $managerStart;
        $effectiveStart30 = $windowStart30->greaterThan($managerStart) ? $windowStart30 : $managerStart;
        $activeDays7 = $effectiveStart7->greaterThan($today) ? 0 : $effectiveStart7->diffInDays($today) + 1;
        $activeDays30 = $effectiveStart30->greaterThan($today) ? 0 : $effectiveStart30->diffInDays($today) + 1;

        foreach ($task_manager->tasks as $task) {
            // Sum actual_value for entries in the active manager window
            $last7Total = $task->entries
                ->filter(fn ($entry) => $entry->entry_date->betweenIncluded($effectiveStart7, $today))
                ->sum('actual_value');
            $last30Total = $task->entries
                ->filter(fn ($entry) => $entry->entry_date->betweenIncluded($effectiveStart30, $today))
                ->sum('actual_value');

            $target7 = $task->daily_target * $activeDays7;
            $target30 = $task->daily_target * $activeDays30;

            // Compute percentage of the target achieved (clamp to 100%)
            $task->progress7_percent = $target7 > 0
                ? min(100, ($last7Total / $target7) * 100)
                : 0;
            $task->progress30_percent = $target30 > 0
                ? min(100, ($last30Total / $target30) * 100)
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
