{{--
    Enhanced home page that displays aggregated progress across all task managers,
    highlights the most used task manager and task, and shows additional
    productivity statistics. It also retains the existing feature, how‑it‑works,
    about us and use cases sections for a complete overview. Place this file
    at `resources/views/home.blade.php` in your Laravel application to
    override the default home view.
--}}

@extends('layouts.app')

@section('title', 'Home')

@push('styles')
    <style>
        .home-wrapper{
            max-width:1200px;
            margin:0 auto;
            padding:40px 20px;
        }
        .overview-grid{
            display:grid;
            gap:20px;
            grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
            margin-bottom:60px;
        }
        .overview-card{
            background:#1e293b;
            border-radius:10px;
            padding:24px;
            box-shadow:0 4px 14px rgba(0,0,0,0.35);
        }
        .overview-card h2{
            color:#f1f5f9;
            margin-bottom:12px;
            font-size:1.4rem;
            font-weight:700;
        }
        .progress-wrapper{
            display:flex;
            align-items:center;
            gap:8px;
            margin-bottom:10px;
        }
        .progress-bar{
            flex:1;
            height:8px;
            background:#334155;
            border-radius:4px;
            overflow:hidden;
        }
        .progress-fill-7{
            height:100%;
            background:linear-gradient(135deg,#059669,#047857);
        }
        .progress-fill-30{
            height:100%;
            background:linear-gradient(135deg,#2563eb,#1d4ed8);
        }
        .details-item{
            color:#94a3b8;
            font-size:0.9rem;
            margin:4px 0;
        }
        /* Feature cards */
        .home-features{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
            gap:20px;
        }
        .home-feature{
            background:#1e293b;
            border-radius:10px;
            padding:24px;
            box-shadow:0 4px 14px rgba(0,0,0,0.35);
            transition:transform 0.2s ease;
        }
        .home-feature:hover{ transform:translateY(-4px); }
        .home-feature h3{
            font-size:1.2rem;
            color:#f1f5f9;
            margin-bottom:8px;
        }
        .home-feature p{
            color:#94a3b8;
            font-size:0.9rem;
        }
        /* How it works */
        .home-how{
            margin-top:60px;
        }
        .home-how h2{
            font-size:1.8rem;
            color:#f1f5f9;
            margin-bottom:24px;
            text-align:center;
        }
        .how-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
            gap:20px;
        }
        .how-card{
            background:#1e293b;
            border-radius:10px;
            padding:24px;
            text-align:center;
            box-shadow:0 4px 14px rgba(0,0,0,0.35);
        }
        .how-card .number{
            font-size:2rem;
            color:#7c3aed;
            font-weight:700;
            margin-bottom:8px;
        }
        .how-card h4{
            color:#f1f5f9;
            font-size:1.2rem;
            margin-bottom:6px;
        }
        .how-card p{
            color:#94a3b8;
            font-size:0.9rem;
        }
        /* About us */
        .home-about{
            margin-top:60px;
            text-align:center;
        }
        .home-about h2{
            font-size:1.8rem;
            color:#f1f5f9;
            margin-bottom:16px;
        }
        .home-about p{
            color:#94a3b8;
            font-size:1rem;
            max-width:700px;
            margin:0 auto;
        }
        /* Use cases */
        .home-use{
            margin-top:60px;
        }
        .home-use h2{
            font-size:1.8rem;
            color:#f1f5f9;
            margin-bottom:24px;
            text-align:center;
        }
        .use-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:20px;
        }
        .use-card{
            background:#1e293b;
            border-radius:10px;
            padding:20px;
            text-align:center;
            box-shadow:0 4px 14px rgba(0,0,0,0.35);
        }
        .use-card h4{
            color:#f1f5f9;
            font-size:1.1rem;
            margin-bottom:6px;
        }
        .use-card p{
            color:#94a3b8;
            font-size:0.9rem;
        }
    </style>
@endpush

@section('content')
    <div class="home-wrapper">
        {{-- Overview Section --}}
        <section class="overview-grid">
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
        {{-- Features --}}
        <section>
            <h2 style="font-size:1.8rem;color:#f1f5f9;margin-bottom:24px;text-align:center;">Features</h2>
            <div class="home-features">
                <div class="home-feature">
                    <h3>Organize with Managers</h3>
                    <p>Create task managers to group related tasks and keep projects separate.</p>
                </div>
                <div class="home-feature">
                    <h3>Set Daily Goals</h3>
                    <p>Assign daily targets to your tasks to stay accountable and consistent.</p>
                </div>
                <div class="home-feature">
                    <h3>Visualize Progress</h3>
                    <p>See your weekly and monthly productivity at a glance with progress bars.</p>
                </div>
                <div class="home-feature">
                    <h3>Stay On Track</h3>
                    <p>Get reminders and insights to ensure you’re always moving towards your goals.</p>
                </div>
            </div>
        </section>
        {{-- How It Works --}}
        <section class="home-how">
            <h2>How It Works</h2>
            <div class="how-grid">
                <div class="how-card">
                    <div class="number">1</div>
                    <h4>Create Manager</h4>
                    <p>Start by creating a task manager for a project or area of your life.</p>
                </div>
                <div class="how-card">
                    <div class="number">2</div>
                    <h4>Add Tasks</h4>
                    <p>Add tasks with daily targets and categorize them with tags.</p>
                </div>
                <div class="how-card">
                    <div class="number">3</div>
                    <h4>Track Daily</h4>
                    <p>Log your daily progress to monitor how you’re performing over time.</p>
                </div>
                <div class="how-card">
                    <div class="number">4</div>
                    <h4>Review Stats</h4>
                    <p>Review insights and statistics to continually improve your productivity.</p>
                </div>
            </div>
        </section>
        {{-- About Us --}}
        <section class="home-about">
            <h2>About Us</h2>
            <p>TaskPlannerM was built out of a desire to help people achieve more by
                organizing their day‑to‑day tasks. Our mission is to provide a simple yet
                powerful tool that keeps you motivated and on track.</p>
        </section>
        {{-- Use Cases --}}
        <section class="home-use">
            <h2>Use Cases</h2>
            <div class="use-grid">
                <div class="use-card">
                    <h4>Students</h4>
                    <p>Stay on top of assignments, study sessions and exam prep.</p>
                </div>
                <div class="use-card">
                    <h4>Developers</h4>
                    <p>Keep track of features, bugs and daily coding goals.</p>
                </div>
                <div class="use-card">
                    <h4>Freelancers</h4>
                    <p>Manage client projects, deadlines and deliverables effectively.</p>
                </div>
                <div class="use-card">
                    <h4>Personal Goals</h4>
                    <p>Build habits, exercise routines or any personal project you’re working on.</p>
                </div>
            </div>
        </section>
    </div>
@endsection
