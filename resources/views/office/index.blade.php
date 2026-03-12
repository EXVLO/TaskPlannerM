@extends('layouts.app')

@section('title', 'Office')

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

        .office-header{
            background:linear-gradient(135deg,#111827,#1f2937,#312e81);
            color:white;
            padding:30px;
            border-radius:18px;
            margin-bottom:24px;
            border:1px solid #1f2937;
            box-shadow:0 12px 30px rgba(0,0,0,0.45);
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

        /* CARD */

        .card{
            background:#111827;
            padding:24px;
            border-radius:16px;
            margin-bottom:22px;
            border:1px solid #1f2937;
            box-shadow:0 12px 30px rgba(0,0,0,0.55);
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

        /* LIST */

        .manager-row{
            display:flex;
            justify-content:space-between;
            align-items:center;
            background:#0b1220;
            border:1px solid #1f2937;
            padding:14px 18px;
            border-radius:12px;
            transition:0.2s;
        }

        .manager-row:hover{
            background:#1a2438;
        }

        .manager-name{
            font-weight:700;
            color:#e5e7eb;
            text-decoration:none;
        }

        .manager-name:hover{
            color:#60a5fa;
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

        .btn-create{
            background:#059669;
            color:white;
        }

        .btn-create:hover{
            background:#047857;
        }

        .btn-edit{
            background:#2563eb;
            color:white;
        }

        .btn-edit:hover{
            background:#1d4ed8;
        }

        .btn-delete{
            background:#dc2626;
            color:white;
        }

        .btn-delete:hover{
            background:#b91c1c;
        }

        .actions{
            display:flex;
            gap:8px;
        }

        .empty-text{
            color:#94a3b8;
        }

        .manager-progress-bars {
            display: flex;
            gap: 12px;
            margin-top: 6px;
        }
        .progress-wrapper {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .progress-label {
            font-size: 10px;
            color: #94a3b8;
            width: 24px;
            text-align: right;
        }
        .progress-bar {
            width: 70px;
            height: 6px;
            background: #1f2937; /* dark bar background */
            border-radius: 4px;
            overflow: hidden;
        }
        .progress-fill-7 {
            height: 100%;
            background: linear-gradient(135deg, #059669, #047857); /* green */
        }
        .progress-fill-30 {
            height: 100%;
            background: linear-gradient(135deg, #2563eb, #1d4ed8); /* blue */
        }

    </style>

    {{--------- --------- ---------}}
    {{--------- Main Part ---------}}
    {{--------- --------- ---------}}

    <div class="container">

        <div class="office-header">

            <div class="page-title">
                Office
            </div>

        </div>

        <div class="card">

            {{-- Add Task Manager Button --}}
            <div style="display:flex;justify-content:space-between;align-items:center">

                <h3 class="section-title">Task Managers</h3>

                <a href="{{ route('office.create') }}" class="btn btn-create">
                    + Add Task Manager
                </a>

            </div>

            @if($taskManagers->isEmpty())

                <p class="empty-text">No task managers yet.</p>

            @else

                {{-- List of Task Managers --}}
                <div class="Task Managers">

                    @foreach ($taskManagers as $manager)
                        <div class="manager-row">
                            <div class="manager-info">
                                <a class="manager-name"
                                   href="{{ route('office.task_managers.show', $manager) }}">
                                    {{ $manager->name }}
                                </a>

                                {{-- progress bars --}}
                                <div class="manager-progress-bars">
                                    <div class="progress-wrapper">
                                        <span class="progress-label">7d</span>
                                        <div class="progress-bar">
                                            <div class="progress-fill-7"
                                                 style="width: {{ round($manager->progress7_percent) }}%;"></div>
                                        </div>
                                    </div>
                                    <div class="progress-wrapper">
                                        <span class="progress-label">30d</span>
                                        <div class="progress-bar">
                                            <div class="progress-fill-30"
                                                 style="width: {{ round($manager->progress30_percent) }}%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                {{-- Action Buttons Edit/Delete --}}
                                <div class="actions">

                                    <a class="btn btn-edit"
                                       href="{{ route('office.task_managers.edit', $manager) }}">
                                        Edit
                                    </a>

                                    <form method="POST"
                                          action="{{ route('office.task_managers.destroy', $manager) }}"
                                          onsubmit="return confirm('Are you sure you want to delete?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-delete">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                        </div>
                    @endforeach

                </div>

            @endif

        </div>

    </div>

@endsection
