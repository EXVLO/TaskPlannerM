<h1>Office</h1>

@if($taskManagers->isEmpty())
    <p>No task managers found.</p>
@else
    <ul>
        @foreach($taskManagers as $taskManager)
            <li>
                <a href="{{ route('office.task_managers.show', $taskManager) }}">
                    {{ $taskManager->name }}
                </a>
            </li>
        @endforeach
    </ul>
@endif
