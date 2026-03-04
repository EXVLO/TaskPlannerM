@extends('layouts.app')

@section('title', 'task')

@section('content')
    <h1>Task Details</h1>

    <h3>Add Tag</h3>

    <form method="POST" action="{{ route('office.tags.store', [$task_manager, $task]) }}">
        @csrf

        <input type="text" name="name" placeholder="Tag name" required>
        <input type="color" name="color">

        <button type="submit">Add</button>
    </form>

    <h3>Tags</h3>

    @foreach ($task->tags as $tag)
        <a href="{{ route('office.tags.show', [$task_manager, $task, $tag]) }}">
            {{ $tag->name }}
        </a>
    @endforeach

    <p>Task Manager: {{ $task_manager->name }}</p>
    <p>Task: {{ $task->name }}</p>

    <a href="{{ route('office.task_managers.show', $task_manager) }}">
        ← Back to Tasks
    </a>
@endsection
