<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Task;
use App\Models\TaskManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    public function index(TaskManager $task_manager, Task $task)
    {
        if ($task_manager->user_id !== Auth::id()) {
            abort(403);
        }

        if ($task->task_manager_id !== $task_manager->id) {
            abort(404);
        }

        $tags = $task->tags;

        return view(
            'office.task_managers.tasks.tags.index',
            compact('task_manager', 'task', 'tags')
        );
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tags')
                    ->where('user_id', auth()->id()),
            ],
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

        return redirect()->route('office.tags.index', [$task_manager, $task])
            ->with('success', 'Tag added successfully.');
    }

    public function update(Request $request, TaskManager $task_manager, Task $task, Tag $tag)
    {
        if ($task_manager->user_id !== Auth::id()) {
            abort(403);
        }

        if ($tag->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:20'],
        ]);

        $tag->update($validated);

        return redirect()->route('office.tags.index', [$task_manager, $task])
            ->with('success', 'Tag updated successfully.');
    }

    public function destroy(TaskManager $task_manager, Task $task, Tag $tag)
    {
        if ($task_manager->user_id !== Auth::id()) {
            abort(403);
        }

        $task->tags()->detach($tag->id);

        return redirect()->route('office.tags.index', [$task_manager, $task])
            ->with('success', 'Tag detached successfully.');
    }
}
