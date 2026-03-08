@extends('layouts.app')

@section('title','Tags')

@section('content')

    <style>

        body{
            background:#f8fafc;
        }

        .container{
            max-width:900px;
            margin:auto;
            font-family:Arial, sans-serif;
        }

        .card{
            background:white;
            padding:22px;
            border-radius:14px;
            margin-bottom:20px;
            box-shadow:0 6px 20px rgba(0,0,0,0.07);
        }

        h2{
            margin-bottom:8px;
        }

        h3{
            margin-top:0;
        }

        input[type="text"],
        input[type="color"]{
            padding:8px 10px;
            border-radius:8px;
            border:1px solid #d1d5db;
            font-size:14px;
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
            background:#059669;
            color:white;
        }

        .btn-add:hover{
            background:#047857;
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

        table{
            width:100%;
            border-collapse:collapse;
        }

        th, td{
            padding:10px;
            border:1px solid #eee;
            text-align:center;
        }

        th{
            background:#f3f4f6;
        }

        tr:hover{
            background:#fafafa;
        }

        .tag-preview{
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .tag-color-box{
            width:22px;
            height:22px;
            border-radius:4px;
            border:1px solid #aaa;
        }

        .success{
            background:#dcfce7;
            color:#166534;
            border:1px solid #bbf7d0;
            padding:12px 16px;
            border-radius:10px;
            margin-bottom:16px;
            font-weight:600;
        }

        .back{
            display:inline-block;
            margin-top:10px;
            color:#2563eb;
            font-weight:600;
            text-decoration:none;
        }

        .back:hover{
            opacity:0.8;
        }

    </style>


    @if(session('success'))

        <div id="success-message" class="success">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(function () {

                const message = document.getElementById('success-message');

                if(message){
                    message.style.transition='opacity 0.5s';
                    message.style.opacity='0';

                    setTimeout(function(){
                        message.remove();
                    },500);
                }

            },2500);
        </script>

    @endif


    <div class="container">

        <div class="card">

            <h2>Manage Tags</h2>

            <p>
                Task Manager: <strong>{{ $task_manager->name }}</strong>
            </p>

            <p>
                Task: <strong>{{ $task->name }}</strong>
            </p>

        </div>


        <div class="card">

            <h3>Add Tag</h3>

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

            <h3>Task Tags</h3>

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
