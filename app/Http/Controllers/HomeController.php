<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $managers = $user->taskManagers()->with(['tasks.entries'])->get();

        $sumActual7 = $sumTarget7 = $sumActual30 = $sumTarget30 = 0;
        $favoriteManager = $favoriteTask = null;
        $favoriteManagerEntries = $favoriteTaskEntries = 0;

        foreach ($managers as $manager) {
            $managerEntryCount = 0;
            foreach ($manager->tasks as $task) {
                $taskEntryCount = $task->entries->count();
                $managerEntryCount += $taskEntryCount;

                if ($taskEntryCount > $favoriteTaskEntries) {
                    $favoriteTaskEntries = $taskEntryCount;
                    $favoriteTask = $task;
                }

                if (! $task->is_active) {
                    continue;
                }

                $actual7 = $task->entries->where('entry_date', '>=', now()->subDays(6)->startOfDay())->sum('actual_value');
                $actual30 = $task->entries->where('entry_date', '>=', now()->subDays(29)->startOfDay())->sum('actual_value');

                $sumActual7 += $actual7;
                $sumActual30 += $actual30;
                $sumTarget7 += $task->daily_target * 7;
                $sumTarget30 += $task->daily_target * 30;
            }
            if ($managerEntryCount > $favoriteManagerEntries) {
                $favoriteManagerEntries = $managerEntryCount;
                $favoriteManager = $manager;
            }
        }

        $progress7Percent = $sumTarget7 > 0 ? min(100, ($sumActual7 / $sumTarget7) * 100) : 0;
        $progress30Percent = $sumTarget30 > 0 ? min(100, ($sumActual30 / $sumTarget30) * 100) : 0;

        $allTasks = $managers->flatMap->tasks;
        $details = [
            'totalManagers' => $managers->count(),
            'activeManagers' => $managers->where('is_active', true)->count(),
            'totalTasks' => $allTasks->count(),
            'activeTasks' => $allTasks->where('is_active', true)->count(),
            'totalEntries' => $allTasks->flatMap->entries->count(),
            'totalTags' => $user->tags()->count(),
        ];

        return view('home', compact(
            'progress7Percent',
            'progress30Percent',
            'favoriteManager',
            'favoriteManagerEntries',
            'favoriteTask',
            'favoriteTaskEntries',
            'details'
        ));
    }
}
