@extends('layouts.app')

@section('title', 'Task')

@section('content')

    <style>
        .container{
            max-width:900px;
            margin:auto;
            font-family:Arial, sans-serif;
        }

        p{
            color:#9ca3af;
        }

        /* HEADER */

        .task-header{
            background:linear-gradient(135deg,#2563eb,#4f46e5);
            color:white;
            padding:30px;
            border-radius:18px;
            margin-bottom:24px;
            box-shadow:0 18px 40px rgba(37,99,235,0.35);
        }

        .task-title{
            font-size:38px;
            font-weight:800;
            margin-bottom:8px;
        }

        .task-meta{
            font-size:15px;
            color:#9ca3af;
        }

        .task-meta strong{
            color:#e5e7eb;
        }

        /* CARDS */

        .card{
            background:#111827;
            padding:24px;
            border-radius:16px;
            margin-bottom:22px;
            border:1px solid #1f2937;
            box-shadow:0 12px 30px rgba(0,0,0,0.55);
        }

        .card h3{
            margin-bottom:18px;
            font-size:24px;
            font-weight:700;
            color:#f1f5f9;
        }

        /* BUTTONS */

        .btn{
            padding:9px 14px;
            border-radius:10px;
            border:none;
            font-size:13px;
            cursor:pointer;
            font-weight:700;
            text-decoration:none;
            display:inline-block;
        }

        .btn-update{
            background:#2563eb;
            color:white;
        }

        .btn-update:hover{
            background:#1d4ed8;
        }

        .btn-delete{
            background:#dc2626;
            color:white;
        }

        .btn-delete:hover{
            background:#b91c1c;
        }

        .btn-save{
            background:#059669;
            color:white;
        }

        .btn-save:hover{
            background:#047857;
        }

        /* INPUTS */

        input[type="date"],
        input[type="number"],
        input[type="text"],
        input[type="color"]{
            padding:9px 10px;
            border-radius:10px;
            border:1px solid #334155;
            background:#0f172a;
            color:#e2e8f0;
            font-size:14px;
        }

        input:focus{
            outline:none;
            border-color:#3b82f6;
        }

        .value-input{
            width:80px;
            text-align:center;
            padding:9px 10px;
            border-radius:10px;
            border:1px solid #334155;
            background:#0f172a;
            color:#e2e8f0;
            font-size:14px;
            appearance:textfield;
            -moz-appearance:textfield;
        }

        .value-input::-webkit-outer-spin-button,
        .value-input::-webkit-inner-spin-button{
            -webkit-appearance:none;
            margin:0;
        }

        /* TABLE */

        table{
            width:100%;
            border-collapse:collapse;
            background:#0b1220;
        }

        th{
            background:#1f2937;
            color:#e5e7eb;
        }

        td{
            color:#cbd5f5;
        }

        th, td{
            padding:12px;
            border:1px solid #1f2937;
            text-align:center;
        }

        tr:hover{
            background:#1a2438;
        }

        /* PERCENT */

        .percent{
            font-weight:bold;
            display:inline-block;
            min-width:60px;
            text-align:left;
        }

        .percent-good{
            color:#22c55e;
        }

        .percent-bad{
            color:#ef4444;
        }

        .percent-infinity{
            color:#22e6cf;
            font-size:28px;
        }

        /* TAGS */

        .tags{
            display:flex;
            flex-wrap:wrap;
            gap:10px;
        }

        .tag{
            padding:7px 14px;
            border-radius:999px;
            font-size:13px;
            font-weight:600;
            color:white;
            box-shadow:0 0 10px rgba(0,0,0,0.5);
            border:1px solid rgba(255,255,255,0.1);
        }

        /* PROGRESS */

        .progress-bar{
            width:100%;
            height:20px;
            border-radius:999px;
            background:#1f2937;
            overflow:hidden;
        }

        .progress-bar-inner{
            height:100%;
            background:linear-gradient(90deg,#22c55e,#16a34a);
        }

        /* HEATMAP */

        .heatmap{
            display:grid;
            grid-template-columns:repeat(10,18px);
            gap:5px;
        }

        .heatmap div{
            width:18px;
            height:18px;
            border-radius:4px;
        }

        /* BACK */

        .back-link{
            color:#60a5fa;
            text-decoration:none;
            font-weight:700;
        }

        .back-link:hover{
            opacity:0.8;
        }

        .page-title{
            margin:0 0 18px 0;
            font-size:40px;
            font-weight:800;
            letter-spacing:-0.6px;
            color:#f9fafb;
            position:relative;
            display:inline-block;
            background:linear-gradient(90deg,#3b82f6,#8b5cf6);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
            background-clip:text;
        }

        .page-title::after{
            content:'';
            display:block;
            width:70%;
            height:4px;
            margin-top:8px;
            border-radius:999px;
            background:linear-gradient(90deg,#3b82f6,#8b5cf6);
            box-shadow:0 0 14px rgba(59,130,246,0.35);
        }

        .section-title{
            margin:0 0 18px 0;
            font-size:28px;
            font-weight:800;
            letter-spacing:-0.4px;
            color:#f9fafb;
            padding-left:14px;
            border-left:4px solid #3b82f6;
            position:relative;
        }

        .section-title::before{
            content:'';
            position:absolute;
            left:-4px;
            top:0;
            bottom:0;
            width:4px;
            border-radius:999px;
            background:linear-gradient(180deg,#3b82f6,#8b5cf6);
            box-shadow:0 0 12px rgba(59,130,246,0.4);
        }

        .section-subtitle{
            background:linear-gradient(135deg,#111827,#1f2937,#312e81);
            margin:-8px 0 16px 14px;
            color:#94a3b8;
            font-size:13px;
            font-weight:500;
            letter-spacing:0.2px;
        }

        .task-header{
            background:linear-gradient(135deg,#111827,#1f2937,#312e81);
            color:white;
            padding:30px;
            border-radius:18px;
            margin-bottom:24px;
            border:1px solid #1f2937;
            box-shadow:0 12px 30px rgba(0,0,0,0.45);
        }

    </style>

    {{--------- --------- ---------}}
    {{--------- Main Part ---------}}
    {{--------- --------- ---------}}

    <div class="container">

        <div class="task-header">

            <div class="page-title">{{ $task->name }}</div>

            <p>
                Task Manager: <strong>{{ $task_manager->name }}</strong>
            </p>

            <p>
                Daily Target: <strong>{{ $task->daily_target }} {{ $task->unit_type }}</strong>
            </p>

        </div>


        <div class="card">

            <div style="display:flex;justify-content:space-between;align-items:center">

                <h3 class="section-title">Tags</h3>

                <a href="{{ route('office.tags.index', [$task_manager,$task]) }}"
                   class="btn btn-update">
                    Manage Tags
                </a>

            </div>

            {{-- List of Tags --}}
            @if($task->tags->isEmpty())

                <p>No tags attached.</p>

            @else

                <div class="tags">

                    @foreach ($task->tags as $tag)

                        <div class="tag"
                             style="background: {{ $tag->color }}">

                            {{ $tag->name }}

                        </div>

                    @endforeach

                </div>

            @endif

        </div>


        <div class="card">

            <h3 class="section-title">Add Entry</h3>

            <form method="POST"
                  action="{{ route('office.tasks.entries.store', [$task_manager, $task]) }}"
                  style="display:flex;gap:10px;flex-wrap:wrap">

                @csrf

                <input type="date"
                       name="entry_date"
                       value="{{ now()->toDateString() }}"
                       required>

                <input type="number"
                       name="actual_value"
                       placeholder="Value"
                       class="value-input"
                       required>

                <button class="btn btn-save">Save</button>

            </form>

        </div>


        <div class="card">

            <h3 class="section-title">Entries</h3>

            @if($task->entries->isEmpty())

                <p>No entries yet.</p>

            @else

                <table>

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

                            $isInfinity = $percent > 500;
                            $displayPercent = $isInfinity ? '∞' : $percent . '%';
                            $good = $percent >= 100;
                        @endphp

                        <tr>

                            <td>
                                {{ $entry->entry_date->format('Y-m-d') }}
                            </td>

                            <td>

                                <form method="POST"
                                      action="{{ route('office.tasks.entries.update', [$task_manager, $task, $entry]) }}"
                                      style="display:flex;justify-content:center;align-items:center;gap:8px">

                                    @csrf
                                    @method('PATCH')

                                    <input type="number"
                                           name="actual_value"
                                           value="{{ $entry->actual_value }}"
                                           class="value-input">

                                    <span class="percent
                                {{ $isInfinity ? 'percent-infinity' : ($good ? 'percent-good' : 'percent-bad') }}
                            ">
                                {{ $displayPercent }}
                            </span>

                            </td>

                            <td>

                                <button class="btn btn-update">Update</button>

                                </form>

                                <form method="POST"
                                      action="{{ route('office.tasks.entries.destroy', [$task_manager, $task, $entry]) }}"
                                      style="display:inline-block">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-delete">Delete</button>

                                </form>

                            </td>

                        </tr>

                    @endforeach

                </table>

            @endif

        </div>


        <div class="card">

            <h3 class="section-title">Last 7 Days Progress</h3>

            @php
                $weekEntries = $task->entries->where('entry_date', '>=', now()->subDays(7));
                $weekDone = $weekEntries->sum('actual_value');
                $weekRequired = $task->daily_target * 7;

                $weekPercent = $weekRequired > 0
                    ? round(($weekDone / $weekRequired) * 100)
                    : 0;
            @endphp

            <p><strong>{{ $weekDone }}</strong> / {{ $weekRequired }}</p>

            <div class="progress-bar">
                <div class="progress-bar-inner" style="width:{{ min($weekPercent,100) }}%"></div>
            </div>

        </div>

        <div class="card">

            <h3 class="section-title">Last 30 Days Progress</h3>

            @php
                $monthEntries = $task->entries->where('entry_date', '>=', now()->subDays(30));
                $monthDone = $monthEntries->sum('actual_value');
                $monthRequired = $task->daily_target * 30;

                $monthPercent = $monthRequired > 0
                    ? round(($monthDone / $monthRequired) * 100)
                    : 0;
            @endphp

            <p><strong>{{ $monthDone }}</strong> / {{ $monthRequired }}</p>

            <div class="progress-bar">
                <div class="progress-bar-inner" style="width:{{ min($monthPercent,100) }}%"></div>
            </div>

        </div>

        <div class="card">

            <h3 class="section-title">Last 30 Days Activity</h3>

            @php
                $days = collect();

                for ($i = 29; $i >= 0; $i--) {

                    $date = now()->subDays($i);

                    $entry = $task->entries
                        ->first(fn($e) => $e->entry_date->isSameDay($date));

                    $value = $entry ? $entry->actual_value : 0;

                    $realPercent = $task->daily_target > 0
                        ? ($value / $task->daily_target) * 100
                        : 0;

                    if ($realPercent > 500) {
                        $color = '#22e6cf';
                    }
                    elseif ($realPercent == 0) {
                        $color = '#1f2937';
                    }
                    elseif ($realPercent < 50) {
                        $color = '#4ade80';
                    }
                    elseif ($realPercent < 100) {
                        $color = '#22c55e';
                    }
                    else {
                        $color = '#166534';
                    }

                    $days->push([
                        'date'=>$date->format('Y-m-d'),
                        'color'=>$color
                    ]);
                }
            @endphp

            <div class="heatmap">

                @foreach($days as $day)

                    <div title="{{ $day['date'] }}"
                         style="background:{{ $day['color'] }}"></div>

                @endforeach

            </div>

        </div>


        <a href="{{ route('office.task_managers.show', $task_manager) }}" class="back-link">
            ← Back to Tasks
        </a>

    </div>

@endsection

