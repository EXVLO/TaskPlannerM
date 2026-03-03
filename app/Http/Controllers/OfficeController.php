<?php

namespace App\Http\Controllers;

use App\Models\TaskManager;
use App\Models\Task;

class OfficeController extends Controller
{
    public function index()
    {
        $taskManagers = TaskManager::latest()->get();

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
}
