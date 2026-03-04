@extends('layouts.app')

@section('title', isset($task_manager) ? 'Edit Task Manager' : 'Create Task Manager')

@section('content')

    <h1>{{ isset($task_manager) ? 'Edit Task Manager' : 'Create Task Manager' }}</h1>

    <form method="POST"
          action="{{ isset($task_manager)
            ? route('office.task_managers.update', $task_manager)
            : route('office.store') }}">

        @csrf

        @if(isset($task_manager))
            @method('PATCH')
        @endif


        {{-- Name --}}
        <div>
            <label>
                Name:
                <input type="text"
                       name="name"
                       value="{{ old('name', $task_manager->name ?? '') }}">
            </label>

            @error('name')
            <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <br>


        {{-- Description --}}
        <div>
            <label>
                Description:
                <textarea name="description">{{ old('description', $task_manager->description ?? '') }}</textarea>
            </label>

            @error('description')
            <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <br>


        {{-- Start Date --}}
        <div>
            <label>
                Start Date:
                <input type="date"
                       name="start_date"
                <input type="date"
                       name="start_date"
                       value="{{ old('start_date', isset($task_manager) ? optional($task_manager->start_date)->format('Y-m-d') : '') }}">
            </label>

            @error('start_date')
            <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <br>


        {{-- Is Active --}}
        <div>
            <label>
                Active:
                <select name="is_active">
                    <option value="1"
                        {{ old('is_active', $task_manager->is_active ?? 1) == 1 ? 'selected' : '' }}>
                        Yes
                    </option>

                    <option value="0"
                        {{ old('is_active', $task_manager->is_active ?? 1) == 0 ? 'selected' : '' }}>
                        No
                    </option>
                </select>
            </label>

            @error('is_active')
            <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <br>


        {{-- Buttons --}}
        <div>
            <button type="submit">
                {{ isset($task_manager) ? 'Update' : 'Create' }}
            </button>

            <a href="{{ route('office.index') }}">Cancel</a>
        </div>

    </form>

@endsection
