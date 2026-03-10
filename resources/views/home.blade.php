{{--
    Enhanced home page for authenticated users of TaskPlannerM.  This page
    welcomes the user back and presents key sections such as features,
    how it works, about us and use cases.  It extends the main layout
    (`layouts.app`) so that the header and footer appear automatically.
    Place this file at `resources/views/home.blade.php` to override the
    default home page.
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
        /* Hero section */
        .home-hero{
            text-align:center;
            padding:80px 0;
        }
        .home-hero h1{
            font-size:2.4rem;
            font-weight:700;
            color:#f1f5f9;
            margin-bottom:12px;
        }
        .home-hero p{
            font-size:1.1rem;
            color:#94a3b8;
            margin-bottom:24px;
        }
        .home-hero .hero-buttons a{
            display:inline-block;
            margin:0 8px;
            padding:12px 24px;
            border-radius:8px;
            font-weight:700;
            transition:opacity 0.3s ease;
        }
        .home-hero .hero-buttons a.primary{
            background:linear-gradient(135deg,#2563eb,#7c3aed);
            color:white;
        }
        .home-hero .hero-buttons a.secondary{
            background:linear-gradient(135deg,#15803d,#22c55e);
            color:white;
        }
        .home-hero .hero-buttons a:hover{
            opacity:0.85;
        }
        /* Features section */
        .home-features{
            margin-top:60px;
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
        /* How it works section */
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
        /* About us section */
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
        /* Use cases section */
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
        {{-- Hero --}}
        <section class="home-hero">
            <h1>Welcome back to TaskPlannerM</h1>
            <p>Your personal space to plan smarter and achieve more every day.</p>
        </section>
        {{-- Features --}}
        <section class="home-features">
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
