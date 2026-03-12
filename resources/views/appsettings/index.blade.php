{{--
    Improved settings page for TaskPlannerM.  This page presents the
    authenticated user's profile information and offers links to manage their
    account.  It uses a card‑based layout on a dark background, consistent
    with the rest of the application.  To apply, replace the content of
    `resources/views/appsettings/index.blade.php` with this file.
--}}

@extends('layouts.app')

@section('title', 'Settings')

@push('styles')
    <style>
        .settings-wrapper{
            max-width:800px;
            margin:0 auto;
            padding:40px 20px;
        }
        .settings-header{
            margin-bottom:32px;
            text-align:center;
        }
        .settings-header h1{
            font-size:2rem;
            font-weight:700;
            color:#f1f5f9;
            margin-bottom:8px;
        }
        .settings-header p{
            color:#94a3b8;
            font-size:1rem;
        }
        .settings-grid{
            display:grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap:20px;
        }
        .settings-card{
            background:#1e293b;
            border-radius:10px;
            padding:24px;
            box-shadow:0 4px 14px rgba(0,0,0,0.35);
        }
        .settings-card h3{
            font-size:1.2rem;
            margin-bottom:12px;
            color:#f1f5f9;
        }
        .settings-card p{
            font-size:0.95rem;
            color:#94a3b8;
            margin-bottom:8px;
        }
        .settings-actions{
            margin-top:32px;
            text-align:center;
        }
        .settings-actions a{
            display:inline-block;
            margin:0 8px;
            padding:12px 24px;
            border-radius:8px;
            font-weight:700;
            transition:opacity 0.3s ease;
        }
        .settings-actions a.primary{
            background:linear-gradient(135deg,#2563eb,#7c3aed);
            color:white;
        }
        .settings-actions a:hover{
            opacity:0.85;
        }

        .text-gradient
        {
            background:linear-gradient(90deg,#3b82f6,#8b5cf6);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
            background-clip:text;
        }
    </style>
@endpush

{{--------- --------- ---------}}
{{--------- Main Part ---------}}
{{--------- --------- ---------}}

@section('content')
    <div class="settings-wrapper">
        <div class="settings-header">
            <h1 class = "text-gradient">Your Settings</h1>
            <p>Manage your account information and preferences.</p>
        </div>
        <div class="settings-grid">
            <div class="settings-card">
                <h3>User Information</h3>
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Member since:</strong> {{ $user->created_at->format('M d, Y') }}</p>
            </div>
            <div class="settings-card">
                <h3>Progress Overview</h3>
                <p>Number of task managers: {{ $taskManagersCount }}</p>
                <p>Number of tasks: {{ $tasksCount }}</p>
                <p>Keep pushing towards your goals!</p>
            </div>
        </div>
        <div class="settings-actions">
            <a href="{{ route('account.edit') }}" class="primary" style="text-decoration:none;"> Change Password</a>
        </div>
    </div>
@endsection
