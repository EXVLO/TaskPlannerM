<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskEntry;
use Illuminate\Http\Request;

class TaskEntryController extends Controller
{
    public function store(Request $request, Task $task)
    {
        $request->validate([
            'entry_date' => 'required|date',
            'actual_value' => 'required|integer|min:0',
        ]);

        TaskEntry::updateOrCreate(
            [
                'task_id' => $task->id,
                'entry_date' => $request->entry_date,
            ],
            [
                'actual_value' => $request->actual_value,
            ]
        );

        return back();
    }
}
