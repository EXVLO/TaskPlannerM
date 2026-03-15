<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskEntry;
use App\Models\TaskManager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskEntryController extends Controller
{
    public function store(Request $request, TaskManager $task_manager, Task $task)
    {
        if ($task->task_manager_id !== $task_manager->id) {
            abort(404);
        }

        if ($task_manager->user_id !== Auth::id()) {
            abort(403);
        }

        $maxEntryDate = Carbon::today()->addDay()->toDateString();

        $request->validate([
            'entry_date' => ['required', 'date', 'after_or_equal:'.$task_manager->start_date->toDateString(), 'before_or_equal:'.$maxEntryDate],
            'actual_value' => 'required|integer|min:0',
        ], [
            'entry_date.after_or_equal' => 'Entry date must be on or after the task manager start date.',
            'entry_date.before_or_equal' => 'Entry date cannot be later than tomorrow.',
        ]);

        $entry = TaskEntry::where('task_id', $task->id)
            ->whereDate('entry_date', $request->entry_date)
            ->first();

        if ($entry) {
            $entry->update([
                'actual_value' => $request->actual_value,
            ]);
        } else {
            TaskEntry::create([
                'task_id' => $task->id,
                'entry_date' => $request->entry_date,
                'actual_value' => $request->actual_value,
            ]);
        }

        return back()->with('success', 'Entry created successfully.');
    }

    public function update(Request $request, TaskManager $task_manager, Task $task, TaskEntry $entry)
    {
        if ($task->task_manager_id !== $task_manager->id || $entry->task_id !== $task->id) {
            abort(404);
        }

        if ($task_manager->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'actual_value' => 'required|integer|min:0',
        ]);

        $entry->update([
            'actual_value' => $request->actual_value,
        ]);

        return back()->with('success', 'Entry updated successfully.');
    }

    public function destroy(TaskManager $task_manager, Task $task, TaskEntry $entry)
    {
        if ($task->task_manager_id !== $task_manager->id || $entry->task_id !== $task->id) {
            abort(404);
        }

        if ($task_manager->user_id !== Auth::id()) {
            abort(403);
        }

        $entry->delete();

        return back()->with('success', 'Entry deleted successfully.');
    }
}
