@extends('layouts.app')

@section('title','Tags')

@section('content')

    <style>

        .container{
            max-width:900px;
            margin:auto;
            font-family:Arial, sans-serif;
        }

        .card{
            background:#111827;
            padding:22px;
            border-radius:12px;
            margin-bottom:20px;
            border:1px solid #1f2937;
            box-shadow:0 8px 20px rgba(0,0,0,0.35);
        }

        h2,h3{
            color:#f9fafb;
        }

        p{
            color:#9ca3af;
        }

        input[type="text"],
        input[type="color"]{
            padding:8px 10px;
            border-radius:8px;
            border:1px solid #374151;
            font-size:14px;
            background:#0b1220;
            color:#e5e7eb;
        }

        input[type="text"]:focus{
            outline:none;
            border-color:#2563eb;
        }

        button{
            padding:7px 14px;
            border-radius:8px;
            border:none;
            font-size:13px;
            cursor:pointer;
            font-weight:600;
        }

        .btn-add{
            background:linear-gradient(135deg,#059669,#047857);
            color:white;
        }

        .btn-update{
            background:linear-gradient(135deg,#2563eb,#1d4ed8);
            color:white;
        }

        .btn-delete{
            background:linear-gradient(135deg,#ef4444,#b91c1c);
            color:white;
        }

        .btn-add:hover,
        .btn-update:hover,
        .btn-delete:hover{
            transform:translateY(-1px);
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th, td{
            padding:10px;
            border:1px solid #1f2937;
            text-align:center;
        }

        th{
            background:#1f2937;
            color:#f3f4f6;
        }

        tr:hover{
            background:#172033;
        }

        .tag-preview{
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .tag-color-box{
            width:22px;
            height:22px;
            border-radius:6px;
            border:1px solid #374151;
        }

        .success{
            background:#052e16;
            color:#4ade80;
            border:1px solid #14532d;
            padding:12px 16px;
            border-radius:10px;
            margin-bottom:16px;
            font-weight:600;
        }

        .back{
            display:inline-block;
            margin-top:10px;
            color:#60a5fa;
            font-weight:600;
            text-decoration:none;
        }

        .back:hover{
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

    <div class="container">

        <div class="task-header">

            <h2 class="page-title">Manage Tags</h2>

            <p>
                Task Manager: <strong>{{ $task_manager->name }}</strong>
            </p>

            <p>
                Task: <strong>{{ $task->name }}</strong>
            </p>

        </div>


        <div class="card">

            <h3 class="section-title">Add Tag</h3>
            <p class="section-subtitle">Create a new label for this task.</p>

            <form method="POST"
                  action="{{ route('office.tags.store',[$task_manager,$task]) }}"
                  style="display:flex;gap:10px;flex-wrap:wrap">

                @csrf

                <input type="text"
                       name="name"
                       placeholder="Tag name"
                       required>

                <input type="color"
                       name="color"
                       value="#000000">

                <button class="btn-add" type="submit">
                    Add Tag
                </button>

            </form>

        </div>


        <div class="card">

            <h3 class="section-title">Task Tags</h3>
            <p class="section-subtitle">Edit, recolor, or detach existing labels.</p>

            @if($tags->isEmpty())

                <p>No tags yet.</p>

            @else

                <table>

                    <tr>
                        <th>Color</th>
                        <th>Name</th>
                        <th>Update</th>
                        <th>Detach</th>
                    </tr>

                    @foreach($tags as $tag)

                        <tr>

                            <td>
                                <div class="tag-preview">
                                    <div class="tag-color-box"
                                         style="background:{{ $tag->color }}"></div>
                                </div>
                            </td>

                            <td>

                                <form method="POST"
                                      action="{{ route('office.tags.update', [$task_manager,$task,$tag]) }}"
                                      style="display:flex;justify-content:center;align-items:center;gap:8px;flex-wrap:wrap">

                                    @csrf
                                    @method('PATCH')

                                    <input type="text"
                                           name="name"
                                           value="{{ $tag->name }}">

                                    <input type="color"
                                           name="color"
                                           value="{{ $tag->color }}">

                            </td>

                            <td>

                                <button class="btn-update" type="submit">
                                    Update
                                </button>

                                </form>

                            </td>

                            <td>

                                <form method="POST"
                                      action="{{ route('office.tags.destroy', [$task_manager,$task,$tag]) }}">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn-delete">
                                        Detach
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @endforeach

                </table>

            @endif

        </div>


        <a href="{{ route('office.tasks.show',[$task_manager,$task]) }}" class="back">
            ← Back to Task
        </a>

    </div>

@endsection
