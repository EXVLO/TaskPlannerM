{{--
    Redesigned header for TaskPlannerM.
    This header keeps the original navigation structure (Home, Office, Settings, News) but
    enhances the styling with gradient accents and active‑state highlighting.
    The “Office” link remains untouched in logic but is styled consistently with
    other links.  To use this header, replace the contents of
    `resources/views/layouts/header.blade.php` with this file.
--}}

<header>
    <style>
        /* Base styling for header */
        .main-header{
            background:#111827;
            border-bottom:1px solid rgba(255,255,255,0.08);
            box-shadow:0 8px 24px rgba(0,0,0,0.35);
        }
        .main-nav{
            max-width:1200px;
            margin:0 auto;
            padding:16px 24px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            flex-wrap:wrap;
            gap:20px;
        }
        /* Brand styling */
        .brand{
            display:flex;
            align-items:center;
            gap:12px;
            text-decoration:none;
        }
        .brand-badge{
            width:42px;
            height:42px;
            border-radius:10px;
            background:linear-gradient(135deg,#2563eb,#7c3aed);
            display:flex;
            align-items:center;
            justify-content:center;
            color:white;
            font-weight:800;
            font-size:16px;
            box-shadow:0 8px 20px rgba(37,99,235,0.3);
            transition:transform 0.2s ease;
        }
        .brand:hover .brand-badge{
            transform:translateY(-2px);
        }
        .brand-text{
            display:flex;
            flex-direction:column;
            line-height:1.1;
        }
        .brand-title{
            color:white;
            font-size:18px;
            font-weight:800;
            letter-spacing:0.3px;
        }
        .brand-subtitle{
            color:#9ca3af;
            font-size:12px;
            margin-top:3px;
            font-weight:600;
        }
        /* Navigation links */
        .nav-links{
            display:flex;
            align-items:center;
            gap:10px;
            flex-wrap:wrap;
        }
        .nav-link{
            text-decoration:none;
            color:#d1d5db;
            font-weight:700;
            font-size:14px;
            padding:10px 16px;
            border-radius:8px;
            transition:all 0.18s ease;
        }
        .nav-link:hover{
            background:#1f2937;
            color:white;
        }

        /* Logout button */
        .logout-form{
            margin:0;
        }
        .logout-btn{
            border:none;
            background:linear-gradient(135deg,#ef4444,#dc2626);
            color:white;
            font-weight:800;
            font-size:14px;
            padding:10px 18px;
            border-radius:8px;
            cursor:pointer;
            transition:all 0.18s ease;
            box-shadow:0 8px 18px rgba(220,38,38,0.25);
        }
        .logout-btn:hover{
            transform:translateY(-1px);
            background:linear-gradient(135deg,#f87171,#dc2626);
        }
        /* Responsive adjustments */
        @media (max-width: 820px){
            .main-nav{
                flex-direction:column;
                align-items:stretch;
            }
            .nav-links{
                justify-content:center;
            }
            .nav-right{
                display:flex;
                justify-content:center;
            }
        }
    </style>
    @php
        // Determine the current route name to apply active state
        $current = request()->route()->getName();
    @endphp
    {{-- Section wrapper --}}
    <div class="main-header">
        <nav class="main-nav">
            <a href="{{ route('welcome') }}" class="brand">
                <div class="brand-badge">TPM</div>
                <div class="brand-text">
                    <span class="brand-title">TaskPlannerM</span>
                    <span class="brand-subtitle">Always one more</span>
                </div>
            </a>
            <div class="nav-links">
                <a href="{{ route('home') }}" class="nav-link {{ $current === 'home' ? 'active' : '' }}">Home</a>
                <a href="{{ route('office.index') }}" class="nav-link {{ $current === 'office.index' ? 'active' : '' }}">Office</a>
                <a href="{{ route('appsettings') }}" class="nav-link {{ $current === 'appsettings' ? 'active' : '' }}">Settings</a>
                <a href="{{ route('news') }}" class="nav-link {{ $current === 'news' ? 'active' : '' }}">News</a>
            </div>
            <div class="nav-right">
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                @endauth
            </div>
        </nav>
    </div>
</header>

