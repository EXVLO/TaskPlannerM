{{--
    This is a redesigned welcome page for TaskPlannerM.  It uses a clean,
    modern dark‑theme layout with sections for features, workflow, use cases
    and a call to action.  A large faint background text (“TaskPlannerM”) adds
    visual interest to the hero section.  The page automatically shows
    login/register buttons when the visitor is not authenticated and a
    home/dashboard button when they are.  To apply this file to your
    application, place it at `resources/views/welcome.blade.php`.
--}}

@extends('layouts.app')

@section('title', 'Welcome')

@push('styles')
    <style>
        /* General resets */
        .welcome-container * {
            box-sizing: border-box;
        }

        .welcome-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Hero section with large background text */
        .welcome-hero {
            position: relative;
            text-align: center;
            padding: 120px 0 80px;
            overflow: hidden;
        }

        .welcome-hero::before {
            content: 'TaskPlannerM';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 10rem;
            font-weight: 900;
            color: rgba(255, 255, 255, 0.05);
            white-space: nowrap;
            pointer-events: none;
        }

        .welcome-hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-weight: 800;
            color: #f1f5f9;
            position: relative;
            z-index: 1;
        }

        .welcome-hero p {
            font-size: 1.2rem;
            color: #94a3b8;
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
        }

        .welcome-hero .cta-main {
            position: relative;
            z-index: 1;
        }

        .welcome-hero .cta-main a {
            display: inline-block;
            margin: 0.5rem;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1rem;
            transition: opacity 0.3s ease;
        }

        .welcome-hero .cta-main a.primary {
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            color: #ffffff;
        }

        .welcome-hero .cta-main a.secondary {
            background: linear-gradient(135deg, #15803d, #22c55e);
            color: #ffffff;
        }

        .welcome-hero .cta-main a:hover {
            opacity: 0.85;
        }

        /* Features grid */
        .welcome-features {
            margin-top: 80px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .feature-card {
            background: #1e293b;
            border-radius: 10px;
            padding: 24px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.35);
            transition: transform 0.2s ease;
        }

        .feature-card:hover {
            transform: translateY(-4px);
        }

        .feature-card h3 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: #f1f5f9;
        }

        .feature-card p {
            color: #94a3b8;
            font-size: 0.95rem;
        }

        /* How it works */
        .welcome-steps {
            margin-top: 80px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }

        .step-card {
            background: #1e293b;
            border-radius: 10px;
            padding: 24px;
            text-align: center;
        }

        .step-card .step-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #7c3aed;
        }

        .step-card h4 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #f1f5f9;
        }

        .step-card p {
            font-size: 0.9rem;
            color: #94a3b8;
        }

        /* Dashboard preview */
        .welcome-preview {
            margin-top: 80px;
            display: flex;
            justify-content: center;
        }

        .welcome-preview img {
            max-width: 100%;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
        }

        /* Use cases */
        .welcome-use-cases {
            margin-top: 80px;
            text-align: center;
        }

        .welcome-use-cases h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #f1f5f9;
            font-weight: 700;
        }

        .cases-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .case-card {
            background: #1e293b;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.35);
            text-align: center;
        }

        .case-card h4 {
            color: #f1f5f9;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .case-card p {
            font-size: 0.9rem;
            color: #94a3b8;
        }

        /* Call to action */
        .welcome-cta {
            margin-top: 80px;
            text-align: center;
        }

        .welcome-cta h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: #f1f5f9;
        }

        .welcome-cta .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .welcome-cta .cta-buttons a {
            padding: 14px 32px;
            border-radius: 8px;
            font-weight: 700;
            transition: opacity 0.3s ease;
            display: inline-block;
        }

        .welcome-cta .cta-buttons a.primary {
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            color: #ffffff;
        }

        .welcome-cta .cta-buttons a.secondary {
            background: linear-gradient(135deg, #15803d, #22c55e);
            color: #ffffff;
        }

        .welcome-cta .cta-buttons a:hover {
            opacity: 0.85;
        }

        @media (max-width: 768px) {
            .welcome-hero h1 {
                font-size: 2.4rem;
            }
            .welcome-hero p {
                font-size: 1rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="welcome-container">
        {{-- Hero Section --}}
        <section class="welcome-hero">
            <h1>Plan Smarter. Achieve More.</h1>
            <p>TaskPlannerM helps you organize tasks, track daily progress, and stay productive.</p>
            <div class="cta-main">
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="primary" style="text-decoration:none;">Login / Register to Get Started</a>
                    @endif
                @else
                    <a href="{{ route('home') }}" class="primary" style="text-decoration:none;">Go to Home Page</a>
                @endguest
            </div>
        </section>

        {{-- Features Section --}}
        <section class="welcome-use-cases">
            <h2>how it works</h2>
            <div class="cases-grid">
                <div class="feature-card">
                    <h3>Task Managers</h3>
                    <p>Organize your projects into separate task managers for better focus and clarity.</p>
                </div>
                <div class="feature-card">
                    <h3>Daily Targets</h3>
                    <p>Set daily goals for each task and keep yourself accountable every day.</p>
                </div>
                <div class="feature-card">
                    <h3>Tag System</h3>
                    <p>Label tasks with tags to categorize and filter your to‑do list quickly.</p>
                </div>
                <div class="feature-card">
                    <h3>Progress Tracking</h3>
                    <p>Visualize your progress with analytics of the past week and month.</p>
                </div>
                <div class="feature-card">
                    <h3>Productivity Dashboard</h3>
                    <p>Get a comprehensive overview of your tasks, targets, and achievements.</p>
                </div>
                <div class="feature-card">
                    <h3>Daily Productivity</h3>
                    <p>Monitor daily performance and stay on top of your game.</p>
                </div>
            </div>
        </section>

        {{-- How It Works Section --}}
        <section class="welcome-use-cases">
            <h2>how it works</h2>
            <div class="cases-grid">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h4>Create a Task Manager</h4>
                    <p>Start by setting up a task manager to group related tasks together.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h4>Add Tasks</h4>
                    <p>Define tasks with daily targets to keep your workload structured.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h4>Track Progress</h4>
                    <p>Record your daily achievements and see your progress accumulate.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">4</div>
                    <h4>Review Statistics</h4>
                    <p>Analyze weekly and monthly statistics to understand your productivity patterns.</p>
                </div>
            </div>
        </section>

        {{-- Use Cases Section --}}
        <section class="welcome-use-cases">
            <h2>Who It's For</h2>
            <div class="cases-grid">
                <div class="case-card">
                    <h4>Students</h4>
                    <p>Manage assignments and study sessions effectively.</p>
                </div>
                <div class="case-card">
                    <h4>Developers</h4>
                    <p>Break down projects and deliver features on time.</p>
                </div>
                <div class="case-card">
                    <h4>Professionals</h4>
                    <p>Stay on top of your work tasks and deadlines effortlessly.</p>
                </div>
                <div class="case-card">
                    <h4>Personal Productivity</h4>
                    <p>Use TaskPlannerM to achieve personal goals and habits.</p>
                </div>
            </div>
        </section>
    </div>
@endsection
