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

                @php
                    $percent = $task->daily_target > 0
                    ? round(($entry->actual_value / $task->daily_target) * 100)
                    : 0;

                    $color = $percent >= 100 ? 'green' : 'red';
                @endphp

                <tr>

                    <td>{{ $entry->entry_date->format('Y-m-d') }}</td>

                    <td>

                        <input type="number"
                               value="{{ $entry->actual_value }}"
                               style="width:70px"
                               readonly>

                        <span style="
display:inline-block;
padding:3px 6px;
margin-left:6px;
background:#eee;
border-radius:4px;
color:{{ $color }};
font-weight:bold;
">
{{ $percent }}%
</span>

                    </td>


                    <td>

                        <form method="POST"
                              action="{{ route('office.tasks.entries.update', [$task_manager, $task, $entry]) }}"
                              style="display:inline;">

                            @csrf
                            @method('PATCH')

                            <input type="hidden"
                                   name="actual_value"
                                   value="{{ $entry->actual_value }}">

                            <button type="submit">Update</button>

                        </form>


                        <form method="POST"
                              action="{{ route('office.tasks.entries.destroy', [$task_manager, $task, $entry]) }}"
                              style="display:inline;margin-left:6px;">

                            @csrf
                            @method('DELETE')

                            <button type="submit">Delete</button>

                        </form>

                    </td>

                </tr>

            @endforeach

        </table>

    @endif


    <hr>


    <h3>Weekly Progress</h3>

    @php
        $weekEntries = $task->entries->where('entry_date', '>=', now()->subDays(7));
        $weekDone = $weekEntries->sum('actual_value');
        $weekRequired = $task->daily_target * 7;

        $weekPercent = $weekRequired > 0
        ? round(($weekDone / $weekRequired) * 100)
        : 0;
    @endphp

    <p>
        <strong>This week:</strong> {{ $weekDone }} / {{ $weekRequired }}
    </p>

    <p>
        <strong>Weekly Completion:</strong>

        @if($weekPercent >= 100)
            <span style="color:green">{{ $weekPercent }}%</span>
        @else
            <span style="color:red">{{ $weekPercent }}%</span>
        @endif

    </p>

    <div style="width:300px;border:1px solid black;height:25px">
        <div style="width:{{ min($weekPercent,100) }}%;height:100%;background-color:green;"></div>
    </div>


    <hr>


    <h3>Monthly Progress</h3>

    @php
        $monthEntries = $task->entries->where('entry_date', '>=', now()->subDays(30));
        $monthDone = $monthEntries->sum('actual_value');
        $monthRequired = $task->daily_target * 30;

        $monthPercent = $monthRequired > 0
        ? round(($monthDone / $monthRequired) * 100)
        : 0;
    @endphp

    <p>
        <strong>This month:</strong> {{ $monthDone }} / {{ $monthRequired }}
    </p>

    <p>
        <strong>Monthly Completion:</strong>

        @if($monthPercent >= 100)
            <span style="color:green">{{ $monthPercent }}%</span>
        @else
            <span style="color:red">{{ $monthPercent }}%</span>
        @endif

    </p>

    <div style="width:300px;border:1px solid black;height:25px">
        <div style="width:{{ min($monthPercent,100) }}%;height:100%;background-color:green;"></div>
    </div>


    <br>

    <a href="{{ route('office.task_managers.show', $task_manager) }}">
        ← Back to Tasks
    </a>

@endsection
