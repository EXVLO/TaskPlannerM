@extends('layouts.app')

@section('title', $task_manager->name)

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

        .manager-header{
            background:linear-gradient(135deg,#111827,#1f2937,#312e81);
            color:white;
            padding:30px;
            border-radius:18px;
            margin-bottom:24px;
            border:1px solid #1f2937;
            box-shadow:0 12px 30px rgba(0,0,0,0.45);
        }

        .page-title{
            margin:0 0 10px 0;
            font-size:40px;
            font-weight:800;
            letter-spacing:-0.6px;
            color:#f9fafb;
            position:relative;
            display:inline-block;
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

        .manager-meta{
            margin-top:10px;
            font-size:14px;
        }

        .manager-meta strong{
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

        /* TASK LIST */

        .tasks{
            display:flex;
            flex-direction:column;
            gap:12px;
        }

        .task-row{
            display:flex;
            justify-content:space-between;
            align-items:center;
            background:#0b1220;
            border:1px solid #1f2937;
            padding:14px 18px;
            border-radius:12px;
            transition:0.2s;
        }

        .task-row:hover{
            background:#1a2438;
        }

        .task-info{
            font-size:16px;
        }

        .task-name{
            font-weight:700;
            color:#e5e7eb;
            text-decoration:none;
        }

        .task-name:hover{
            color:#60a5fa;
        }

        .task-target{
            font-size:13px;
            color:#94a3b8;
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

        /* ACTIONS */

        .actions{
            display:flex;
            gap:8px;
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

    </style>

    <div class="container">

        <div class="manager-header">

            <div class="page-title">
                {{ $task_manager->name }}
            </div>

            <p>{{ $task_manager->description }}</p>

            <div class="manager-meta">

                <p>
                    Start Date:
                    <strong>{{ $task_manager->start_date }}</strong>
                </p>

                <p>
                    Status:
                    <strong>
                        {{ $task_manager->is_active ? 'Active' : 'Inactive' }}
                    </strong>
                </p>

            </div>

        </div>


        <div class="card">

            <div style="display:flex;justify-content:space-between;align-items:center">

                <h3 class="section-title">Tasks</h3>

                <a href="{{ route('office.tasks.create', $task_manager) }}"
                   class="btn btn-create">
                    + Add Task
                </a>

            </div>

            @if($task_manager->tasks->isEmpty())

                <p>No tasks yet.</p>

            @else

                <div class="tasks">

                    @foreach($task_manager->tasks as $task)

                        <div class="task-row">

                            <div class="task-info">

                                <a class="task-name"
                                   href="{{ route('office.tasks.show', [$task_manager, $task]) }}">
                                    {{ $task->name }}
                                </a>

                                <div class="task-target">
                                    {{ $task->daily_target }} {{ $task->unit_type }} / day
                                </div>

                            </div>

                            <div class="actions">

                                <a class="btn btn-edit"
                                   href="{{ route('office.tasks.edit', [$task_manager,$task]) }}">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('office.tasks.destroy', [$task_manager,$task]) }}">
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


        <a href="{{ route('office.index') }}" class="back-link">
            ← Back to Task Managers
        </a>

    </div>

@endsection
