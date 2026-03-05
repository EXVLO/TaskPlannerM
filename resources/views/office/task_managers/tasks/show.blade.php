@extends('layouts.app')

@section('title', 'Task')

@section('content')

    <h2>Task Information</h2>

    <p>
        <strong>Task Manager:</strong> {{ $task_manager->name }}
    </p>

    <p>
        <strong>Task:</strong> {{ $task->name }}
    </p>

    <p>
        <strong>Daily Target:</strong> {{ $task->daily_target }} {{ $task->unit_type }}
    </p>

    <hr>


    <h3>Add Tag</h3>

    <form method="POST" action="{{ route('office.tags.store', [$task_manager, $task]) }}">
        @csrf

        <input type="text" name="name" placeholder="Tag name" required>
        <input type="color" name="color" value="#000000">

        <button type="submit">Add</button>
    </form>

    <hr>


    <h3>Tags</h3>

    @if($task->tags->isEmpty())
        <p>No tags yet.</p>
    @else
        <ul>
            @foreach ($task->tags as $tag)

                <li>

                    {{-- Update Tag --}}
                    <form method="POST"
                          action="{{ route('office.tags.update', [$task_manager, $task, $tag]) }}"
                          style="display:inline;">
                        @csrf
                        @method('PATCH')

                        <input type="text"
                               name="name"
                               value="{{ $tag->name }}"
                               style="width:120px">

                        <input type="color"
                               name="color"
                               value="{{ $tag->color }}">

                        <button type="submit">Update</button>
                    </form>


                    {{-- Delete Tag --}}
                    <form method="POST"
                          action="{{ route('office.tags.destroy', [$task_manager, $task, $tag]) }}"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit">Delete</button>
                    </form>

                </li>

            @endforeach
        </ul>
    @endif


    <hr>


    <h3>Add Entry</h3>

    <form method="POST"
          action="{{ route('office.tasks.entries.store', [$task_manager, $task]) }}">

        @csrf

        <label>Date</label>
        <input type="date"
               name="entry_date"
               value="{{ now()->toDateString() }}"
               required>

        <label>Value</label>
        <input type="number"
               name="actual_value"
               style="width:80px"
               required>

        <button type="submit">Save</button>

    </form>


    <hr>


    <h3>Entries</h3>

    @if($task->entries->isEmpty())
        <p>No entries yet.</p>
    @else

        <table border="1">

            <tr>
                <th>Date</th>
                <th>Value</th>
                <th>Actions</th>
            </tr>

            @foreach ($task->entries->sortByDesc('entry_date') as $entry)

                <tr>

                    <td>
                        {{ $entry->entry_date->format('Y-m-d') }}
                    </td>

                    <td>

                        <form method="POST"
                              action="{{ route('office.tasks.entries.update', [$task_manager, $task, $entry]) }}"
                              style="display:inline;">

                            @csrf
                            @method('PATCH')

                            <input type="number"
                                   name="actual_value"
                                   value="{{ $entry->actual_value }}"
                                   style="width:80px">

                            <button type="submit">
                                Update
                            </button>

                        </form>

                    </td>

                    <td>

                        <form method="POST"
                              action="{{ route('office.tasks.entries.destroy', [$task_manager, $task, $entry]) }}"
                              style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button type="submit">
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>

            @endforeach

        </table>

    @endif


    <br>

    <a href="{{ route('office.task_managers.show', $task_manager) }}">
        ← Back to Tasks
    </a>

@endsection
