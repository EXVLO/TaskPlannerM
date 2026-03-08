@extends('layouts.app')

@section('title', 'Task')

@section('content')

    <style>

        body{
            background:#f8fafc;
        }

        .container{
            max-width:950px;
            margin:auto;
            font-family:Arial, sans-serif;
            padding:20px 0 40px 0;
        }

        .task-header{
            background:linear-gradient(135deg,#2563eb,#4f46e5);
            color:white;
            padding:28px;
            border-radius:18px;
            margin-bottom:24px;
            box-shadow:0 12px 30px rgba(37,99,235,0.22);
            transition:transform 0.2s ease, box-shadow 0.2s ease;
        }

        .task-header:hover{
            transform:translateY(-2px);
            box-shadow:0 18px 38px rgba(37,99,235,0.28);
        }

        .task-title{
            font-size:38px;
            font-weight:800;
            margin:0 0 10px 0;
            letter-spacing:0.2px;
        }

        .task-meta{
            font-size:15px;
            opacity:0.95;
            line-height:1.7;
        }

        .card{
            background:white;
            padding:22px;
            border-radius:16px;
            margin-bottom:20px;
            box-shadow:0 6px 20px rgba(15,23,42,0.07);
            border:1px solid #eef2f7;
            transition:transform 0.18s ease, box-shadow 0.18s ease;
        }

        .card:hover{
            transform:translateY(-1px);
            box-shadow:0 10px 24px rgba(15,23,42,0.10);
        }

        .card h3{
            margin:0 0 16px 0;
            font-size:22px;
            color:#111827;
        }

        table{
            width:100%;
            border-collapse:collapse;
            overflow:hidden;
            border-radius:12px;
        }

        th, td{
            padding:12px 10px;
            border:1px solid #edf2f7;
            text-align:center;
        }

        th{
            background:#f8fafc;
            color:#374151;
            font-size:14px;
        }

        tr:hover{
            background:#f9fbff;
        }

        .col-date{
            width:160px;
        }

        .col-value{
            width:200px;
        }

        .col-actions{
            width:180px;
        }

        input[type="date"],
        input[type="number"],
        input[type="text"],
        input[type="color"]{
            padding:9px 10px;
            border-radius:10px;
            border:1px solid #d1d5db;
            font-size:14px;
            outline:none;
            transition:border-color 0.15s ease, box-shadow 0.15s ease;
        }

        input[type="date"]:focus,
        input[type="number"]:focus,
        input[type="text"]:focus,
        input[type="color"]:focus{
            border-color:#2563eb;
            box-shadow:0 0 0 3px rgba(37,99,235,0.12);
        }

        .value-input{
            width:80px;
            text-align:center;
        }

        .percent{
            display:inline-block;
            min-width:58px;
            font-weight:bold;
            font-size:20px;
        }

        .percent-good{
            color:#16a34a;
        }

        .percent-bad{
            color:#dc2626;
        }

        .percent-infinity{
            color:#22e6cf;
            font-size:29px;
            font-weight:bold;
            line-height:1;
        }

        .btn{
            padding:9px 14px;
            border-radius:10px;
            border:none;
            font-size:13px;
            cursor:pointer;
            font-weight:700;
            transition:all 0.15s ease;
        }

        .btn:hover{
            transform:translateY(-1px);
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

        .progress-bar{
            width:100%;
            height:20px;
            border-radius:999px;
            background:#e5e7eb;
            overflow:hidden;
            margin-top:8px;
            box-shadow:inset 0 1px 2px rgba(0,0,0,0.08);
        }

        .progress-bar-inner{
            height:100%;
            background:linear-gradient(90deg,#22c55e,#16a34a);
            transition:width 0.5s ease;
        }

        .heatmap{
            display:grid;
            grid-template-columns:repeat(10,18px);
            gap:5px;
        }

        .heatmap div{
            width:18px;
            height:18px;
            border-radius:5px;
            border:1px solid rgba(0,0,0,0.05);
            transition:transform 0.12s ease, box-shadow 0.12s ease;
        }

        .heatmap div:hover{
            transform:scale(1.22);
            box-shadow:0 2px 6px rgba(0,0,0,0.18);
        }

        .date-infinity{
            background:#22e6cf;
            font-weight:bold;
        }

        .tags-list{
            display:flex;
            flex-direction:column;
            gap:12px;
        }

        .tag-row{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:14px;
            padding:14px;
            border:1px solid #edf2f7;
            border-radius:12px;
            background:#fafcff;
            flex-wrap:wrap;
        }

        .tag-preview{
            display:flex;
            align-items:center;
            gap:10px;
            min-width:160px;
        }

        .tag-color-box{
            width:18px;
            height:18px;
            border-radius:50%;
            border:1px solid rgba(0,0,0,0.15);
            flex-shrink:0;
        }

        .tag-name{
            font-weight:700;
            color:#1f2937;
        }

        .tag-form{
            display:flex;
            align-items:center;
            gap:10px;
            flex-wrap:wrap;
        }

        .section-row-form{
            display:flex;
            gap:10px;
            flex-wrap:wrap;
            align-items:center;
        }

        .back-link{
            display:inline-block;
            margin-top:6px;
            color:#2563eb;
            text-decoration:none;
            font-weight:700;
            transition:opacity 0.15s ease;
        }

        .back-link:hover{
            opacity:0.8;
        }

        .muted-text{
            font-size:12px;
            color:#6b7280;
            margin-top:8px;
        }

    </style>

    <div class="container">

        <div class="task-header">
            <div class="task-title">
                {{ $task->name }}
            </div>

            <div class="task-meta">
                <div>Task Manager: <strong>{{ $task_manager->name }}</strong></div>
                <div>Daily Target: <strong>{{ $task->daily_target }} {{ $task->unit_type }}</strong></div>
            </div>
        </div>

        <div class="card">

            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">

                <h3 style="margin:0">Tags</h3>

                <a href="{{ route('office.tags.index', [$task_manager,$task]) }}"
                   class="btn btn-update">
                    Manage Tags
                </a>

            </div>

            @if($task->tags->isEmpty())

                <p>No tags attached.</p>

            @else

                <div style="display:flex;flex-wrap:wrap;gap:10px">

                    @foreach ($task->tags as $tag)

                        <div style="
                    background: {{ $tag->color }};
                    color:white;
                    padding:6px 12px;
                    border-radius:999px;
                    font-size:13px;
                    font-weight:600;
                    box-shadow:0 2px 6px rgba(0,0,0,0.15);
                ">
                            {{ $tag->name }}
                        </div>

                    @endforeach

                </div>

            @endif

        </div>

        <div class="card">

            <h3>Add Entry</h3>

            <form method="POST"
                  action="{{ route('office.tasks.entries.store', [$task_manager, $task]) }}"
                  class="section-row-form">

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

                <button class="btn btn-save" type="submit">Save</button>

            </form>

        </div>

        <div class="card">

            <h3>Entries</h3>

            @if($task->entries->isEmpty())

                <p>No entries yet.</p>

            @else

                <table>

                    <tr>
                        <th class="col-date">Date</th>
                        <th class="col-value">Value</th>
                        <th class="col-actions">Actions</th>
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

                            <td class="{{ $isInfinity ? 'date-infinity' : '' }}">
                                {{ $entry->entry_date->format('Y-m-d') }}
                            </td>

                            <td>

                                <form method="POST"
                                      action="{{ route('office.tasks.entries.update', [$task_manager, $task, $entry]) }}"
                                      style="display:flex;align-items:center;justify-content:center;gap:8px;flex-wrap:wrap;">

                                    @csrf
                                    @method('PATCH')

                                    <input type="number"
                                           name="actual_value"
                                           value="{{ $entry->actual_value }}"
                                           class="value-input"
                                           required>

                                    <span class="
                                    percent
                                    {{ $isInfinity ? 'percent-infinity' : ($good ? 'percent-good' : 'percent-bad') }}
                                ">
                                    {{ $displayPercent }}
                                </span>

                            </td>

                            <td>

                                <button class="btn btn-update" type="submit">Update</button>

                                </form>

                                <form method="POST"
                                      action="{{ route('office.tasks.entries.destroy', [$task_manager, $task, $entry]) }}"
                                      style="display:inline-block;margin-left:6px;">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-delete" type="submit">Delete</button>

                                </form>

                            </td>

                        </tr>

                    @endforeach

                </table>

            @endif

        </div>

        <div class="card">

            <h3>Last 7 Days Progress</h3>

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
                <div class="progress-bar-inner" style="width:{{ min($weekPercent, 100) }}%"></div>
            </div>

        </div>

        <div class="card">

            <h3>Last 30 Days Progress</h3>

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
                <div class="progress-bar-inner" style="width:{{ min($monthPercent, 100) }}%"></div>
            </div>

        </div>

        <div class="card">

            <h3>Last 30 Days Activity</h3>

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
                        $color = '#ebedf0';
                    }
                    elseif ($realPercent < 50) {
                        $color = '#9be9a8';
                    }
                    elseif ($realPercent < 100) {
                        $color = '#40c463';
                    }
                    else {
                        $color = '#216e39';
                    }

                    $days->push([
                        'date' => $date->format('Y-m-d'),
                        'color' => $color
                    ]);
                }
            @endphp

            <div class="heatmap">

                @foreach($days as $day)
                    <div
                        title="{{ $day['date'] }}"
                        style="background:{{ $day['color'] }}">
                    </div>
                @endforeach

            </div>

            <p class="muted-text">
                Light → Dark = more progress
            </p>

        </div>

        <a href="{{ route('office.task_managers.show', $task_manager) }}" class="back-link">
            ← Back to Tasks
        </a>

    </div>

@endsection
