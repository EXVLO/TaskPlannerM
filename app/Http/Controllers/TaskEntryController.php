<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskEntry;
use App\Models\TaskManager;
use Illuminate\Http\Request;

class TaskEntryController extends Controller
{
    public function store(Request $request, TaskManager $task_manager, Task $task)
    {
        $request->validate([
            'entry_date' => 'required|date',
            'actual_value' => 'required|integer|min:0',
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

        return back();
    }

    public function update(Request $request, TaskManager $task_manager, Task $task, TaskEntry $entry)
    {
        $request->validate([
            'actual_value' => 'required|integer|min:0',
        ]);

        $entry->update([
            'actual_value' => $request->actual_value,
        ]);

        return back();
    }

    public function destroy(TaskManager $task_manager, Task $task, TaskEntry $entry)
    {
        $entry->delete();

        return back();
    }
}
