<?php

namespace App\Http\Controllers;

use App\Models\Task;

class AppSettingsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $taskManagersCount = $user->taskManagers()->count();
        $tasksCount = Task::query()
            ->whereHas('taskManager', fn ($query) => $query->where('user_id', $user->id))
            ->count();

        return view('appsettings.index', compact('user', 'taskManagersCount', 'tasksCount'));
    }
}
