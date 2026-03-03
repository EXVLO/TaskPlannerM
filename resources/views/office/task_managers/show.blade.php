<h1>{{ $task_manager->name }}</h1>

@if($task_manager->tasks->isEmpty())
    <p>No tasks in this task manager.</p>
@else
    <ul>
        @foreach($task_manager->tasks as $task)
            <li>
                <a href="{{ route('office.tasks.show', [$task_manager, $task]) }}">
                    {{ $task->name }}
                </a>
            </li>
        @endforeach
    </ul>
@endif

<p><a href="{{ route('office.index') }}">← Back to Task Managers</a></p>
