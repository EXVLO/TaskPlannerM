{{--
    Redesigned news page for TaskPlannerM.  This page displays a collection of
    news or update cards to keep users informed about the latest features
    and improvements.  Each card includes a headline, date and description.
    Replace the contents of `resources/views/news/index.blade.php` with this
    file to use it in your application.
--}}

@extends('layouts.app')

@section('title', 'News')

@push('styles')
    <style>
        .news-wrapper{
            max-width:1000px;
            margin:0 auto;
            padding:40px 20px;
        }
        .news-header{
            text-align:center;
            margin-bottom:32px;
        }
        .news-header h1{
            font-size:2rem;
            font-weight:700;
            color:#f1f5f9;
            margin-bottom:8px;
        }
        .news-header p{
            color:#94a3b8;
            font-size:1rem;
        }
        .news-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
            gap:20px;
        }
        .news-card{
            background:#1e293b;
            border-radius:10px;
            overflow:hidden;
            box-shadow:0 4px 14px rgba(0,0,0,0.35);
            transition:transform 0.2s ease;
        }
        .news-card:hover{
            transform:translateY(-4px);
        }
        .news-card img{
            width:100%;
            height:160px;
            object-fit:cover;
        }
        .news-card-content{
            padding:20px;
        }
        .news-card-content h3{
            font-size:1.25rem;
            color:#f1f5f9;
            margin-bottom:8px;
        }
        .news-card-content .date{
            font-size:0.8rem;
            color:#64748b;
            margin-bottom:8px;
        }
        .news-card-content p{
            font-size:0.9rem;
            color:#94a3b8;
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

@section('content')
    <div class="news-wrapper">
        <div class="news-header">
            <h1 class = "text-gradient">News & Updates</h1>
            <p>Stay informed about what’s new and upcoming at TaskPlannerM.</p>
        </div>
        <div class="news-grid">
            {{-- Example news cards. Replace or loop through real news items as needed. --}}
            <div class="news-card">
                <div class="news-card-content">
                    <h3>New Dashboard Released</h3>
                    <div class="date">March 1, 2026</div>
                    <p>We’ve launched a refreshed dashboard with improved analytics and a more responsive design to help you track your productivity better.</p>
                </div>
            </div>
            <div class="news-card">
                <div class="news-card-content">
                    <h3>Tagging System Upgrade</h3>
                    <div class="date">February 20, 2026</div>
                    <p>Tags now support custom colors and descriptions, making it easier to categorize and filter your tasks efficiently.</p>
                </div>
            </div>
            <div class="news-card">
                <div class="news-card-content">
                    <h3>Mobile App Coming Soon</h3>
                    <div class="date">February 5, 2026</div>
                    <p>We’re excited to announce that a mobile version of TaskPlannerM is underway, bringing task management to your fingertips.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
