@extends('layouts.app')

@section('title', $task_manager->name)

@section('content')

    <h1>{{ $task_manager->name }}</h1>

    <p>{{ $task_manager->description }}</p>

    <p>
        <strong>Start Date:</strong> {{ $task_manager->start_date }}
        |
        <strong>Status:</strong>
        {{ $task_manager->is_active ? 'Active' : 'Inactive' }}
    </p>

    <hr>

    <h2>Tasks</h2>

    <p>
        <a href="{{ route('office.tasks.create', $task_manager) }}">
            <button type="button">+ Add Task</button>
        </a>
    </p>

    @if($task_manager->tasks->isEmpty())
        <p>No tasks yet.</p>
    @else
        <ul>
            @foreach($task_manager->tasks as $task)
                <li>

                    <a href="{{ route('office.tasks.show', [$task_manager, $task]) }}">
                        {{ $task->name }}
                    </a>

                    ({{ $task->daily_target }} {{ $task->unit_type }})

                    <a href="{{ route('office.tasks.edit', [$task_manager,$task]) }}">
                        Edit
                    </a>

                    <form method="POST"
                          action="{{ route('office.tasks.destroy', [$task_manager,$task]) }}"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit">Delete</button>
                    </form>

                </li>
            @endforeach
        </ul>
    @endif

    <br>

    <a href="{{ route('office.index') }}">← Back to Task Managers</a>

@endsection
