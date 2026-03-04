@extends('layouts.app')

@section('title', 'Office')

@section('content')
    <h1>Task Managers</h1>

    <a href="{{ route('office.create') }}">+ Add Task Manager</a>

    <ul>
        @foreach($taskManagers as $taskManager)
            <li>

                <a href="{{ route('office.task_managers.show', $taskManager) }}">
                    {{ $taskManager->name }}
                </a>

                <a href="{{ route('office.task_managers.edit', $taskManager) }}">
                    Edit
                </a>

                <form method="POST"
                      action="{{ route('office.task_managers.destroy', $taskManager) }}"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button type="submit">Delete</button>
                </form>

            </li>
        @endforeach
    </ul>

@endsection
