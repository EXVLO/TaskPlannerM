@extends('layouts.app')

@section('title', 'Create Task Manager')

@section('content')
    <h1>Create Task Manager</h1>

    <form method="POST" action="{{ route('office.store') }}">
        @csrf

        {{-- Name --}}
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

        {{-- Description --}}
        <div>
            <label>
                Description:
                <textarea name="description">{{ old('description') }}</textarea>
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
                <input type="date" name="start_date" value="{{ old('start_date') }}">
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
                    <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>No</option>
                </select>
            </label>

            @error('is_active')
            <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        {{-- Buttons --}}
        <div>
            <button type="submit">Create</button>
            <a href="{{ route('office.index') }}">Cancel</a>
        </div>

    </form>
@endsection
