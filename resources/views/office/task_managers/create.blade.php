@extends('layouts.app')

@section('title', 'Create Task Manager')

@section('content')
    <h1>Create Task Manager</h1>

    <form method="POST" action="{{ route('office.store') }}">
        @csrf

        <label>
            Name:
            <input type="text" name="name" value="{{ old('name') }}">
        </label>
        <label>
            Start Date:
            <input type="date" name="start_date" value="{{ old('start_date') }}">
        </label>

        @error('start_date')
        <p style="color:red;">{{ $message }}</p>
        @enderror

        @error('name')
        <p style="color:red;">{{ $message }}</p>
        @enderror

        <div style="margin-top: 10px;">
            <button type="submit">Create</button>
            <a href="{{ route('office.index') }}">Cancel</a>
        </div>
    </form>
@endsection
