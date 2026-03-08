@extends('layouts.app')

@section('title','Tags')

@section('content')

    @if(session('success'))
        <div id="success-message" style="
        background:#dcfce7;
        color:#166534;
        border:1px solid #bbf7d0;
        padding:12px 16px;
        border-radius:10px;
        margin-bottom:16px;
        font-weight:600;
        box-shadow:0 4px 10px rgba(0,0,0,0.08);
    ">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(function () {
                const message = document.getElementById('success-message');
                if (message) {
                    message.style.transition = 'opacity 0.5s ease';
                    message.style.opacity = '0';

                    setTimeout(function () {
                        message.remove();
                    }, 500);
                }
            }, 2500);
        </script>
    @endif

    <div style="max-width:900px;margin:auto;font-family:Arial">

        <h2>Manage Tags</h2>

        <p>
            Task Manager: <strong>{{ $task_manager->name }}</strong>
        </p>

        <p>
            Task: <strong>{{ $task->name }}</strong>
        </p>

        <hr>

        <h3>Add Tag</h3>

        <form method="POST"
              action="{{ route('office.tags.store',[$task_manager,$task]) }}">

            @csrf

            <input type="text"
                   name="name"
                   placeholder="Tag name"
                   required>

            <input type="color"
                   name="color"
                   value="#000000">

            <button type="submit">
                Add Tag
            </button>

        </form>

        <hr>

        <h3>Task Tags</h3>

        @if($tags->isEmpty())

            <p>No tags yet.</p>

        @else

            <table style="width:100%;border-collapse:collapse">

                <tr>
                    <th style="border:1px solid #ddd;padding:8px">Color</th>
                    <th style="border:1px solid #ddd;padding:8px">Name</th>
                    <th style="border:1px solid #ddd;padding:8px">Update</th>
                    <th style="border:1px solid #ddd;padding:8px">Detach</th>
                </tr>

                @foreach($tags as $tag)

                    <tr>

                        <td style="border:1px solid #ddd;padding:8px;text-align:center">
                            <div style="
                    width:22px;
                    height:22px;
                    margin:auto;
                    background:{{ $tag->color }};
                    border:1px solid #999;
                    border-radius:4px;
                "></div>
                        </td>

                        <td style="border:1px solid #ddd;padding:8px;text-align:center">
                            <form method="POST"
                                  action="{{ route('office.tags.update', [$task_manager, $task, $tag]) }}"
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

                        <td style="border:1px solid #ddd;padding:8px;text-align:center">
                            <button type="submit">Update</button>
                            </form>
                        </td>

                        <td style="border:1px solid #ddd;padding:8px;text-align:center">
                            <form method="POST"
                                  action="{{ route('office.tags.destroy', [$task_manager, $task, $tag]) }}">

                                @csrf
                                @method('DELETE')

                                <button type="submit">Detach</button>
                            </form>
                        </td>

                    </tr>

                @endforeach

            </table>

        @endif

        <hr>

        <a href="{{ route('office.tasks.show',[$task_manager,$task]) }}">
            Back to Task
        </a>

    </div>

@endsection
