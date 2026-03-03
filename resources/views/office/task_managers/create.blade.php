@extends('layouts.app')

@section('title', 'Create Task')

@section('content')
    <h1>Create Task</h1>

    <p>
        Task Manager:
        <strong>{{ $task_manager->name }}</strong>
    </p>

    <form method="POST" action="{{ route('office.tasks.store', $task_manager) }}">
        @csrf

        <div>
            <label>
                Name:
                <input type="text" name="name" value="{{ old('name') }}">
            </label>
            @error('name')
            <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label>
                Target Value:
                <input type="number" name="daily_target" value="{{ old('daily_target') }}">
            </label>
            @error('target_value')
            <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label>
                Unit Type:
                <input type="text" name="unit_type" placeholder="pages, minutes, km..." value="{{ old('unit_type') }}">
            </label>
            @error('unit_type')
            <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label>
                Start Date:
                <input type="date" name="start_date" value="{{ old('start_date') }}">
            </label>
            @error('start_date')
            <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label>
                Active:
                <select name="is_active">
                    <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>No</option>
                </select>
            </label>
            @error('is_active')
            <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">Create Task</button>
        <a href="{{ route('office.task_managers.show', $task_manager) }}">Cancel</a>
    </form>
@endsection
