@extends('layouts.app')

@section('title', 'Home')

@push('styles')
    <style>
        .overview-grid{
            display:grid;
            gap:26px;
            grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
            margin-bottom:70px;
        }

        .overview-card{
            position:relative;
            padding:28px;
            border-radius:16px;
            background:linear-gradient(145deg,#0f172a,#1e293b);
            border:1px solid rgba(255,255,255,0.05);
            backdrop-filter:blur(8px);
            box-shadow:
                0 10px 30px rgba(0,0,0,0.6),
                inset 0 1px 0 rgba(255,255,255,0.05);
            transition:
                transform 0.35s ease,
                box-shadow 0.35s ease,
                border-color 0.35s ease,
                background 0.35s ease;
        }

        .overview-card:hover{
            transform:translateY(-12px) scale(1.025);
            border-color:rgba(99,102,241,0.35);
            box-shadow:
                0 24px 60px rgba(0,0,0,0.75),
                0 0 24px rgba(99,102,241,0.22),
                inset 0 1px 0 rgba(255,255,255,0.08);
        }

        .overview-card h2{
            font-size:18px;
            font-weight:700;
            margin-bottom:18px;

            background:linear-gradient(90deg,#60a5fa,#a78bfa);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
        }

        .progress-wrapper{
            display:flex;
            align-items:center;
            gap:10px;
            margin-bottom:14px;
        }

        .progress-bar{
            flex:1;
            height:10px;
            background:#020617;
            border-radius:6px;
            overflow:hidden;
            border:1px solid rgba(255,255,255,0.04);
        }

        .progress-fill-7{
            height:100%;
            background:linear-gradient(90deg,#22c55e,#16a34a);
            box-shadow:0 0 10px rgba(34,197,94,0.5);
        }

        .progress-fill-30{
            height:100%;
            background:linear-gradient(90deg,#3b82f6,#6366f1);
            box-shadow:0 0 12px rgba(59,130,246,0.5);
        }

        .details-item{
            color:#9ca3af;
            font-size:14px;
            margin:6px 0;
        }

        .details-item strong{
            color:#cbd5e1;
            font-weight:600;
            font-size:16px;
        }

        /* glowing border effect */

        .overview-card::before{
            content:"";
            position:absolute;
            inset:0;
            border-radius:16px;
            padding:1px;

            background:linear-gradient(120deg,#6366f1,#3b82f6,#22c55e);

            -webkit-mask:
                linear-gradient(#000 0 0) content-box,
                linear-gradient(#000 0 0);

            -webkit-mask-composite:xor;
            mask-composite:exclude;

            opacity:.15;
        }

        .text-gradient
        {
            background:linear-gradient(90deg,#3b82f6,#8b5cf6);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
            background-clip:text;
        }

        .home-page-title{
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

        .home-page-title::after{
            content:'';
            display:block;
            width:70%;
            height:4px;
            margin-top:8px;
            border-radius:999px;
            background:linear-gradient(90deg,#3b82f6,#8b5cf6);
            box-shadow:0 0 14px rgba(59,130,246,0.35);
        }
    </style>
@endpush

{{--------- --------- ---------}}
{{--------- Main Part ---------}}
{{--------- --------- ---------}}

@section('content')
    <h1 class="text-gradient home-page-title">Home</h1>
    <div class="home-wrapper">
        {{-- Overview Section --}}
        <section class="overview-grid">
            <div class="overview-card">
                <h2>Streaks</h2>
                <p class="details-item">Current streak: <strong>{{ $currentStreak }} day{{ $currentStreak === 1 ? '' : 's' }}</strong></p>
                <p class="details-item">Best streak: <strong>{{ $bestStreak }} day{{ $bestStreak === 1 ? '' : 's' }}</strong></p>
            </div>
            <div class="overview-card">
                <h2>Productivity Score</h2>
                <p class="details-item"><strong>{{ $productivityScore }}%</strong> (combined 7d & 30d progress)</p>
            </div>
            <div class="overview-card">
                <h2>Overall Progress</h2>
                <div class="progress-wrapper">
                    <span style="width:28px;color:#94a3b8;font-size:0.8rem;">7d</span>
                    <div class="progress-bar">
                        <div class="progress-fill-7" style="width: {{ round($progress7Percent) }}%;"></div>
                    </div>
                    <span style="width:32px;color:#94a3b8;font-size:0.8rem;">{{ round($progress7Percent) }}%</span>
                </div>
                <div class="progress-wrapper">
                    <span style="width:28px;color:#94a3b8;font-size:0.8rem;">30d</span>
                    <div class="progress-bar">
                        <div class="progress-fill-30" style="width: {{ round($progress30Percent) }}%;"></div>
                    </div>
                    <span style="width:32px;color:#94a3b8;font-size:0.8rem;">{{ round($progress30Percent) }}%</span>
                </div>
            </div>
            <div class="overview-card">
                <h2>Favourite Manager</h2>
                @if($favoriteManager)
                    <p class="details-item"><strong>{{ $favoriteManager->name }}</strong></p>
                    <p class="details-item">Tasks: {{ $favoriteManager->tasks->count() }}</p>
                    <p class="details-item">Entries: {{ $favoriteManagerEntries }}</p>
                @else
                    <p class="details-item">No data available yet.</p>
                @endif
            </div>
            <div class="overview-card">
                <h2>Favourite Task</h2>
                @if($favoriteTask)
                    <p class="details-item"><strong>{{ $favoriteTask->name }}</strong></p>
                    <p class="details-item">Manager: {{ $favoriteTask->taskManager->name }}</p>
                    <p class="details-item">Entries: {{ $favoriteTaskEntries }}</p>
                @else
                    <p class="details-item">No data available yet.</p>
                @endif
            </div>
            <div class="overview-card">
                <h2>Additional Details</h2>
                <p class="details-item">Managers: {{ $details['totalManagers'] }} ({{ $details['activeManagers'] }} active)</p>
                <p class="details-item">Tasks: {{ $details['totalTasks'] }} ({{ $details['activeTasks'] }} active)</p>
                <p class="details-item">Entries logged: {{ $details['totalEntries'] }}</p>
                <p class="details-item">Tags: {{ $details['totalTags'] }}</p>
            </div>
        </section>
        {{-- Missed Tasks --}}
        <section class="overview-grid">
            <div class="overview-card" style="grid-column: 1 / -1;">
                <h2>Missed Tasks</h2>
                @forelse($missedTasks as $task)
                    @php
                        $todaySum = $task->entries->where('entry_date', today())->sum('actual_value');
                        $remaining = $task->daily_target - $todaySum;
                    @endphp
                    <p class="details-item">
                        <strong>{{ $task->name }}</strong> – you are {{ $remaining }} {{ $task->unit_type }}
                        short of today’s target ({{ $todaySum }} / {{ $task->daily_target }}).
                    </p>
                @empty
                    <p class="details-item">Great job! You met all your targets today.</p>
                @endforelse
            </div>
        </section>
        {{-- Goal Proggress --}}
        <section class="overview-grid">
            <div class="overview-card" style="grid-column: 1 / -1;">
                <h2>Monthly Goal</h2>
                <p class="details-item">
                    Target: <strong>{{ $monthlyTarget }}</strong> &nbsp;
                    Completed: <strong>{{ $actualMonthEntries }}</strong>
                </p>
                @php
                    $goalPercent = $monthlyTarget > 0
                        ? min(100, round(($actualMonthEntries / $monthlyTarget) * 100))
                        : 0;
                @endphp
                <div class="progress-bar">
                    <div class="progress-fill-30" style="width: {{ $goalPercent }}%;"></div>
                </div>
            </div>
        </section>
        {{-- Recent Activity --}}
        <section class="overview-grid">
            <div class="overview-card" style="grid-column: 1 / -1;">
                <h2>Recent Activity</h2>
                @forelse($recentEntries as $entry)
                    <p class="details-item">
                        ✔ {{ $entry->entry_date->format('M d, Y') }} – Logged
                        <strong>{{ $entry->actual_value }}</strong> {{ $entry->task->unit_type }}
                        for <strong>{{ $entry->task->name }}</strong>
                    </p>
                @empty
                    <p class="details-item">No recent activity.</p>
                @endforelse
            </div>
        </section>
        {{-- About Us --}}
        <section class="home-about">
            <h2>About Us</h2>
            <p>TaskPlannerM was first created for study purposes as a way to practice modern web development concepts and improve software engineering skills.<br>
                Over time, it became a structured productivity tool focused on helping users stay organized and manage daily tasks more efficiently.<br>
                The application encourages consistent progress, clear planning, and better personal productivity habits.<br>
                It also reflects continuous learning, practical experimentation, and the process of turning ideas into real working features.</p>
        </section>
    </div>
    <blockquote style="font-style:italic;color:#cbd5e1;text-align:right;">{{ $quoteOfTheDay }}</blockquote>
@endsection
