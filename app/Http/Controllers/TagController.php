<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Task;
use App\Models\TaskManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    public function show(TaskManager $task_manager, Task $task, Tag $tag)
    {
        if ($task_manager->user_id !== Auth::id()) {
            abort(403);
        }

        if ($task->task_manager_id !== $task_manager->id) {
            abort(404);
        }

        if (! $task->tags()->where('tags.id', $tag->id)->exists()) {
            abort(404);
        }

        return view(
            'office.task_managers.tasks.tags.show',
            compact('task_manager', 'task', 'tag')
        );
    }

    public function destroy(TaskManager $task_manager, Task $task, Tag $tag)
    {
        if ($task_manager->user_id !== Auth::id()) {
            abort(403);
        }

        if ($task->task_manager_id !== $task_manager->id) {
            abort(404);
        }

        if (! $task->tags()->where('tags.id', $tag->id)->exists()) {
            abort(404);
        }

        $task->tags()->detach($tag->id);

        return redirect()->back();
    }

    public function update(Request $request, TaskManager $task_manager, Task $task, Tag $tag)
    {
        if ($task_manager->user_id !== Auth::id()) {
            abort(403);
        }

        if ($task->task_manager_id !== $task_manager->id) {
            abort(404);
        }

        if ($tag->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:7'],
        ]);

        $tag->update($validated);

        return redirect()->route('office.tasks.show', [$task_manager, $task]);
    }

    public function store(Request $request, TaskManager $task_manager, Task $task)
    {
        if ($task_manager->user_id !== Auth::id()) {
            abort(403);
        }

        if ($task->task_manager_id !== $task_manager->id) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:20'],
        ]);

        $tag = Tag::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'name' => $validated['name'],
            ],
            [
                'color' => $validated['color'] ?? '#000000',
            ]
        );

        $task->tags()->syncWithoutDetaching([$tag->id]);

        return redirect()->route('office.tasks.show', [$task_manager, $task]);
    }
}
