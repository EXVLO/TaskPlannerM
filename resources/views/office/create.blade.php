@extends('layouts.app')

@section('title', isset($task_manager) ? 'Edit Task Manager' : 'Create Task Manager')

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

        /* FORM */

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
        input[type="date"],
        textarea,
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

        textarea{
            min-height:100px;
            resize:vertical;
        }

        input::placeholder{
            color:#64748b;
        }

        input:focus,
        textarea:focus,
        select:focus{
            outline:none;
            border-color:#3b82f6;
            box-shadow:0 0 0 3px rgba(59,130,246,0.15);
        }

        /* ERROR */

        .error-text{
            margin:0;
            color:#f87171;
            font-size:13px;
            font-weight:600;
        }

        /* BUTTONS */

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

    </style>

    {{--------- --------- ---------}}
    {{--------- Main Part ---------}}
    {{--------- --------- ---------}}

    <div class="container">

        <div class="form-header">

            <div class="page-title">
                {{ isset($task_manager) ? 'Edit Task Manager' : 'Create Task Manager' }}
            </div>

        </div>

        <div class="card">

            <h3 class="section-title">Manager Details</h3>


            <form method="POST"
                  action="{{ isset($task_manager)
                ? route('office.task_managers.update', $task_manager)
                : route('office.store') }}">

                @csrf

                @if(isset($task_manager))
                    @method('PATCH')
                @endif

                <div class="form-grid">

                    {{-- Name --}}
                    <div class="form-group">

                        <label class="form-label">Name</label>

                        <input type="text"
                               name="name"
                               placeholder="Enter manager name"
                               value="{{ old('name', $task_manager->name ?? '') }}">

                        @error('name')
                        <p class="error-text">{{ $message }}</p>
                        @enderror

                    </div>


                    {{-- Description --}}
                    <div class="form-group">

                        <label class="form-label">Description</label>

                        <textarea name="description"
                                  placeholder="Describe this task manager">{{ old('description', $task_manager->description ?? '') }}</textarea>

                        @error('description')
                        <p class="error-text">{{ $message }}</p>
                        @enderror

                    </div>


                    {{-- Start Date --}}
                    <div class="form-group">

                        <label class="form-label">Start Date</label>

                        <input type="date"
                               name="start_date"
                               value="{{ old('start_date', isset($task_manager) ? optional($task_manager->start_date)->format('Y-m-d') : '') }}">

                        @error('start_date')
                        <p class="error-text">{{ $message }}</p>
                        @enderror

                    </div>


                    {{-- Active --}}
                    <div class="form-group">

                        <label class="form-label">Active</label>

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

                        @error('is_active')
                        <p class="error-text">{{ $message }}</p>
                        @enderror

                    </div>

                </div>

                <div class="btn-row">

                    <button type="submit" class="btn btn-save">
                        {{ isset($task_manager) ? 'Update Manager' : 'Create Manager' }}
                    </button>

                    <a href="{{ route('office.index') }}" class="btn btn-cancel">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

@endsection

