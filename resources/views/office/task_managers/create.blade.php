@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Create Task')

@section('content')

    <h1>{{ isset($task) ? 'Edit Task' : 'Create Task' }}</h1>

    <p>
        Task Manager:
        <strong>{{ $task_manager->name }}</strong>
    </p>

    <form method="POST"
          action="{{ isset($task)
        ? route('office.tasks.update', [$task_manager, $task])
        : route('office.tasks.store', $task_manager) }}">

        @csrf

        @isset($task)
            @method('PATCH')
        @endisset


        {{-- Name --}}
        <div>
            <label>
                Name:
                <input type="text"
                       name="name"
                       value="{{ old('name', $task->name ?? '') }}">
            </label>

            @error('name')
            <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <br>


        {{-- Daily Target --}}
        <div>
            <label>
                Daily Target:
                <input type="number"
                       name="daily_target"
                       value="{{ old('daily_target', $task->daily_target ?? '') }}">
            </label>

            @error('daily_target')
            <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <br>


        {{-- Unit Type --}}
        <div>
            <label>
                Unit Type:
                <input type="text"
                       name="unit_type"
                       placeholder="pages, minutes, km..."
                       value="{{ old('unit_type', $task->unit_type ?? '') }}">
            </label>

            @error('unit_type')
            <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <br>


        {{-- Active --}}
        <div>
            <label>
                Active:
                <select name="is_active">

                    <option value="1"
                        {{ old('is_active', $task->is_active ?? 1) == 1 ? 'selected' : '' }}>
                        Yes
                    </option>

                    <option value="0"
                        {{ old('is_active', $task->is_active ?? 1) == 0 ? 'selected' : '' }}>
                        No
                    </option>

                </select>
            </label>

            @error('is_active')
            <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">
            {{ isset($task) ? 'Update Task' : 'Create Task' }}
        </button>

        <a href="{{ route('office.task_managers.show', $task_manager) }}">
            Cancel
        </a>

    </form>

@endsection
