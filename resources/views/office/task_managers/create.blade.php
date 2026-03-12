@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Create Task')

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

        .form-header{
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

        .form-grid{
            display:grid;
            gap:18px;
        }

        .form-group{
            display:flex;
            flex-direction:column;
            gap:8px;
        }

        .form-label{
            color:#e5e7eb;
            font-size:14px;
            font-weight:700;
        }

        input[type="text"],
        input[type="number"],
        select{
            width:100%;
            padding:12px 14px;
            border-radius:12px;
            border:1px solid #334155;
            background:#0f172a;
            color:#e2e8f0;
            font-size:14px;
            box-sizing:border-box;
        }

        input[type="text"]::placeholder{
            color:#64748b;
        }

        input[type="number"]{
            appearance:textfield;
            -moz-appearance:textfield;
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button{
            -webkit-appearance:none;
            margin:0;
        }

        input:focus,
        select:focus{
            outline:none;
            border-color:#3b82f6;
            box-shadow:0 0 0 3px rgba(59,130,246,0.15);
        }

        .error-text{
            margin:0;
            color:#f87171;
            font-size:13px;
            font-weight:600;
        }

        .btn-row{
            display:flex;
            gap:10px;
            align-items:center;
            margin-top:10px;
            flex-wrap:wrap;
        }

        .btn{
            padding:10px 16px;
            border-radius:10px;
            border:none;
            font-size:13px;
            cursor:pointer;
            font-weight:700;
            text-decoration:none;
            display:inline-block;
        }

        .btn-save{
            background:#059669;
            color:white;
        }

        .btn-save:hover{
            background:#047857;
        }

        .btn-cancel{
            background:#1f2937;
            color:#e5e7eb;
            border:1px solid #374151;
        }

        .btn-cancel:hover{
            background:#374151;
        }

        .header-meta strong{
            color:#f3f4f6;
        }
    </style>

    {{--------- --------- ---------}}
    {{--------- Main Part ---------}}
    {{--------- --------- ---------}}

    <div class="container">

        <div class="form-header">

            <div class="page-title">
                {{ isset($task) ? 'Edit Task' : 'Create Task' }}
            </div>

            <p class="header-meta">
                Task Manager:
                <strong>{{ $task_manager->name }}</strong>
            </p>

        </div>

        <div class="card">

            <h3 class="section-title">Task Details</h3>

            <form method="POST"
                  action="{{ isset($task)
                    ? route('office.tasks.update', [$task_manager, $task])
                    : route('office.tasks.store', $task_manager) }}">

                @csrf

                @isset($task)
                    @method('PATCH')
                @endisset

                <div class="form-grid">

                    <div class="form-group">
                        <label class="form-label" for="name">Name</label>

                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name', $task->name ?? '') }}"
                               placeholder="Enter task name">

                        @error('name')
                        <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="daily_target">Daily Target</label>

                        <input type="number"
                               id="daily_target"
                               name="daily_target"
                               value="{{ old('daily_target', $task->daily_target ?? '') }}"
                               placeholder="Enter daily target">

                        @error('daily_target')
                        <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="unit_type">Unit Type</label>

                        <input type="text"
                               id="unit_type"
                               name="unit_type"
                               placeholder="pages, minutes, km..."
                               value="{{ old('unit_type', $task->unit_type ?? '') }}">

                        @error('unit_type')
                        <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="is_active">Active</label>

                        <select name="is_active" id="is_active">
                            <option value="1"
                                {{ old('is_active', $task->is_active ?? 1) == 1 ? 'selected' : '' }}>
                                Yes
                            </option>

                            <option value="0"
                                {{ old('is_active', $task->is_active ?? 1) == 0 ? 'selected' : '' }}>
                                No
                            </option>
                        </select>

                        @error('is_active')
                        <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="btn-row">
                    <button type="submit" class="btn btn-save">
                        {{ isset($task) ? 'Update Task' : 'Create Task' }}
                    </button>

                    <a href="{{ route('office.task_managers.show', $task_manager) }}"
                       class="btn btn-cancel">
                        Cancel
                    </a>
                </div>

            </form>

        </div>

    </div>

@endsection
