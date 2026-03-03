@extends('layouts.app')

@section('title', 'task')

@section('content')
    <h1>Task Details</h1>

    <p>Task Manager: {{ $task_manager->name }}</p>
    <p>Task: {{ $task->name }}</p>

    <a href="{{ route('office.task_managers.show', $task_manager) }}">
        ← Back to Tasks
    </a>
@endsection
