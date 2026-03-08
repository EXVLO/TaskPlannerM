<header>
    <style>
        body{
            background:#0f172a;
            color:#e5e7eb;
            margin:0;
        }

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
            gap:20px;
        }

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

        @media (max-width: 820px){
            .main-nav{
                flex-direction:column;
                align-items:stretch;
            }

            .brand{
                justify-content:center;
            }

            .brand-text{
                align-items:center;
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

    <div class="main-header">
        <nav class="main-nav">
            <a href="{{ route('home') }}" class="brand">
                <div class="brand-badge">TPM</div>

                <div class="brand-text">
                    <span class="brand-title">TaskPlannerM</span>
                    <span class="brand-subtitle">Always one more</span>
                </div>
            </a>

            <div class="nav-links">
                <a href="{{ route('home') }}" class="nav-link">Home</a>
                <a href="{{ route('office.index') }}" class="nav-link">Office</a>
                <a href="{{ route('appsettings') }}" class="nav-link">Settings</a>
                <a href="{{ route('news') }}" class="nav-link">News</a>
            </div>

            <div class="nav-right">
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </nav>
    </div>
</header>
