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

        // Calculate current and best streaks
        $entryDates = $managers->flatMap->tasks
            ->flatMap->entries
            ->pluck('entry_date')
            ->map(fn ($d) => $d->format('Y-m-d'))
            ->unique()
            ->sortDesc();

        $currentStreak = 0;
        $bestStreak = 0;
        $prevDate = null;
        foreach ($entryDates as $date) {
            if ($prevDate && (strtotime($prevDate) - strtotime($date)) === 86400) {
                $currentStreak++;
            } else {
                $currentStreak = 1;
            }
            if ($currentStreak > $bestStreak) {
                $bestStreak = $currentStreak;
            }
            $prevDate = $date;
        }

        $progress7Percent = $sumTarget7 > 0 ? min(100, ($sumActual7 / $sumTarget7) * 100) : 0;
        $progress30Percent = $sumTarget30 > 0 ? min(100, ($sumActual30 / $sumTarget30) * 100) : 0;

        $productivityScore = round($progress7Percent * 0.7 + $progress30Percent * 0.3);

        $recentEntries = $managers->flatMap->tasks
            ->flatMap->entries
            ->sortByDesc('entry_date')
            ->take(5);

        $allTasks = $managers->flatMap->tasks;
        $details = [
            'totalManagers' => $managers->count(),
            'activeManagers' => $managers->where('is_active', true)->count(),
            'totalTasks' => $allTasks->count(),
            'activeTasks' => $allTasks->where('is_active', true)->count(),
            'totalEntries' => $allTasks->flatMap->entries->count(),
            'totalTags' => $user->tags()->count(),
        ];

        $quotes = [
            'Success is the sum of small efforts repeated daily.',
            'Stay focused and keep moving forward.',
            'Discipline beats motivation.',
            'Small progress is still progress.',
            'Dream big, start small, act now.',
            'Discipline is choosing between what you want now and what you want most.',
            'Small steps every day add up to big results.',
            'Focus on progress, not perfection.',
        ];

        $quoteOfTheDay = $quotes[array_rand($quotes)];

        $missedTasks = $managers->flatMap->tasks->filter(function ($task) {
            if (! $task->is_active) {
                return false;
            }
            $todaySum = $task->entries->where('entry_date', today())->sum('actual_value');
            return $todaySum < $task->daily_target;
        });

        $daysInMonth = now()->daysInMonth;
        $monthlyTarget = $managers->flatMap->tasks
            ->filter->is_active
            ->sum(function ($task) use ($daysInMonth) {
                return $task->daily_target * $daysInMonth;
            });

        $actualMonthEntries = $managers->flatMap->tasks
            ->flatMap->entries
            ->where('entry_date', '>=', now()->startOfMonth())
            ->sum('actual_value');

        return view('home', compact(
            'progress7Percent',
            'progress30Percent',
            'favoriteManager',
            'favoriteManagerEntries',
            'favoriteTask',
            'favoriteTaskEntries',
            'details',
            'currentStreak',
            'bestStreak',
            'productivityScore',
            'recentEntries',
            'quoteOfTheDay',
            'missedTasks',
            'monthlyTarget',
            'actualMonthEntries',
        ));
    }
}
