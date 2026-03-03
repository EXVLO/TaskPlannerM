@extends('layouts.app')

@section('title', 'Task Manager')

@section('content')
    <h1>{{ $task_manager->name }}</h1>

    <button type="button" onclick="toggleForm()">
        + Add Task
    </button>

    <div id="task-form" style="display:none; margin-top:15px;">
        <form method="POST" action="{{ route('office.tasks.store', $task_manager) }}">
            @csrf

            <label>
                Task Name:
                <input type="text" name="name" value="{{ old('name') }}">
            </label>

            @error('name')
            <p style="color:red;">{{ $message }}</p>
            @enderror

            <br><br>

            <label>
                Due Date:
                <input type="date" name="due_date" value="{{ old('due_date') }}">
            </label>

            @error('due_date')
            <p style="color:red;">{{ $message }}</p>
            @enderror

            <label>
                Daily Target:
                <input type="number" name="daily_target" value="{{ old('daily_target') }}">
            </label>

            @error('daily_target')
            <p style="color:red;">{{ $message }}</p>
            @enderror

            <br><br>

            <button type="submit">Create Task</button>
        </form>
    </div>

    <script>
        function toggleForm() {
            const form = document.getElementById('task-form');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>

    <hr>

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

    <a href="{{ route('office.index') }}">← Back</a>
@endsection
