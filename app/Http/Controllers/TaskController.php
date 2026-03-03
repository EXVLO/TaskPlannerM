<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskManager;

class TaskController extends Controller
{
    // GET /office/{task_manager}/{task}
    public function show(TaskManager $task_manager, Task $task)
    {
        return view('office.tasks.show', compact('task_manager', 'task'));
    }
}
