@extends('layouts.app')

@section('title', 'Home')

@push('styles')
    <style>
        :root{
            --ink:#e6edf7;
            --muted:#9db0c8;
            --line:rgba(157,176,200,.2);
            --panel:linear-gradient(145deg,rgba(9,20,38,.9),rgba(8,30,40,.82));
            --accent-cyan:#2dd4bf;
            --accent-blue:#38bdf8;
            --accent-amber:#f59e0b;
            --glow:0 18px 44px rgba(0,0,0,.42);
        }

        .home-shell{
            display:grid;
            gap:24px;
            font-family:"Space Grotesk","Sora","Manrope",sans-serif;
            color:var(--ink);
        }

        .hero{
            position:relative;
            overflow:hidden;
            border-radius:28px;
            border:1px solid var(--line);
            background:
                radial-gradient(circle at 12% 20%,rgba(45,212,191,.20),transparent 45%),
                radial-gradient(circle at 90% 12%,rgba(56,189,248,.24),transparent 42%),
                radial-gradient(circle at 80% 88%,rgba(245,158,11,.18),transparent 38%),
                linear-gradient(120deg,#07111f,#0a2234 55%,#07202a);
            box-shadow:var(--glow);
            min-height:360px;
        }

        #hero-canvas{
            position:absolute;
            inset:0;
            width:100%;
            height:100%;
            opacity:.52;
            pointer-events:none;
        }

        .hero-grid{
            position:relative;
            display:grid;
            gap:22px;
            grid-template-columns:1.25fr .9fr;
            padding:34px;
            z-index:1;
        }

        .kicker{
            display:inline-flex;
            align-items:center;
            gap:8px;
            border:1px solid rgba(45,212,191,.45);
            border-radius:999px;
            padding:6px 12px;
            color:#b9fff3;
            font-size:.78rem;
            letter-spacing:.08em;
            text-transform:uppercase;
            margin-bottom:14px;
            background:rgba(8,44,52,.4);
        }

        .hero h1{
            margin:0 0 10px;
            font-size:clamp(1.8rem,3.6vw,3rem);
            line-height:1.02;
            letter-spacing:-.02em;
            max-width:16ch;
        }

        .hero p{
            margin:0;
            color:var(--muted);
            max-width:58ch;
            line-height:1.6;
        }

        .micro-stats{
            display:grid;
            gap:10px;
            margin-top:18px;
            grid-template-columns:repeat(3,minmax(0,1fr));
        }

        .pill{
            background:rgba(8,18,32,.54);
            border:1px solid var(--line);
            border-radius:14px;
            padding:10px 12px;
        }

        .pill .label{
            font-size:.73rem;
            color:#89a1c0;
            text-transform:uppercase;
            letter-spacing:.08em;
        }

        .pill .value{
            margin-top:4px;
            font-size:1.2rem;
            font-weight:700;
        }

        .visual{
            position:relative;
            border-radius:20px;
            border:1px solid var(--line);
            background:rgba(6,16,30,.55);
            min-height:250px;
            display:grid;
            place-items:center;
            overflow:hidden;
        }

        .orbit,
        .orbit::before{
            position:absolute;
            border-radius:50%;
            border:1px solid rgba(56,189,248,.33);
            content:"";
        }

        .orbit.one{
            width:86%;
            aspect-ratio:1;
            animation:spin 18s linear infinite;
        }

        .orbit.two{
            width:60%;
            aspect-ratio:1;
            border-color:rgba(45,212,191,.45);
            animation:spin-reverse 12s linear infinite;
        }

        .orbit::before{
            width:9px;
            height:9px;
            top:8%;
            left:50%;
            transform:translateX(-50%);
            background:#7dd3fc;
            box-shadow:0 0 16px rgba(125,211,252,.7);
        }

        .score-ring{
            --score:0;
            width:150px;
            aspect-ratio:1;
            border-radius:50%;
            background:conic-gradient(var(--accent-cyan) calc(var(--score) * 1%), rgba(148,163,184,.2) 0);
            display:grid;
            place-items:center;
            box-shadow:0 0 26px rgba(45,212,191,.28);
            z-index:2;
        }

        .score-ring::after{
            content:"";
            width:76%;
            height:76%;
            border-radius:50%;
            background:#08192a;
            border:1px solid rgba(157,176,200,.28);
        }

        .score-content{
            position:absolute;
            text-align:center;
            z-index:3;
        }

        .score-content .big{
            font-size:2rem;
            font-weight:800;
        }

        .score-content .small{
            font-size:.75rem;
            color:#91a7c6;
            letter-spacing:.07em;
            text-transform:uppercase;
        }

        .grid{
            display:grid;
            gap:18px;
            grid-template-columns:repeat(12,minmax(0,1fr));
        }

        .card{
            grid-column:span 4;
            border:1px solid var(--line);
            border-radius:18px;
            background:var(--panel);
            box-shadow:var(--glow);
            padding:18px;
            position:relative;
            overflow:hidden;
        }

        .card::before{
            content:"";
            position:absolute;
            inset:auto -20% -40%;
            height:120px;
            background:radial-gradient(circle,rgba(45,212,191,.2),transparent 60%);
        }

        .card h3{
            margin:0 0 10px;
            font-size:.95rem;
            color:#a4b7ce;
            letter-spacing:.08em;
            text-transform:uppercase;
        }

        .card .big{
            font-size:2rem;
            font-weight:800;
            letter-spacing:-.02em;
        }

        .bar{
            margin-top:10px;
            height:10px;
            border-radius:999px;
            background:rgba(148,163,184,.2);
            overflow:hidden;
        }

        .bar > span{
            display:block;
            height:100%;
            border-radius:inherit;
            background:linear-gradient(90deg,var(--accent-cyan),var(--accent-blue));
        }

        .split{
            display:grid;
            gap:18px;
            grid-template-columns:1fr 1fr;
        }

        .panel{
            border:1px solid var(--line);
            border-radius:18px;
            background:var(--panel);
            box-shadow:var(--glow);
            padding:18px;
        }

        .panel h2{
            margin:0 0 12px;
            font-size:1.02rem;
            text-transform:uppercase;
            letter-spacing:.09em;
            color:#b2c2d6;
        }

        .task-list{
            display:grid;
            gap:10px;
        }

        .task-item{
            display:grid;
            gap:4px;
            border:1px solid rgba(239,68,68,.28);
            background:rgba(37,10,10,.22);
            border-radius:12px;
            padding:10px 12px;
        }

        .task-item .name{
            font-weight:700;
            color:#fecaca;
        }

        .task-item .meta{
            font-size:.9rem;
            color:#fca5a5;
        }

        .timeline{
            display:grid;
            gap:10px;
        }

        .timeline-item{
            display:grid;
            grid-template-columns:16px 1fr;
            gap:10px;
        }

        .dot{
            width:10px;
            height:10px;
            border-radius:50%;
            background:var(--accent-cyan);
            margin-top:7px;
            box-shadow:0 0 12px rgba(45,212,191,.7);
            animation:pulse 2s ease-in-out infinite;
        }

        .timeline-item p{
            margin:0;
            color:var(--muted);
            line-height:1.45;
        }

        .goal{
            margin-top:18px;
            padding:16px;
            border-radius:14px;
            border:1px solid var(--line);
            background:rgba(8,16,30,.55);
        }

        .goal strong{
            color:#ecfeff;
        }

        .quote{
            border-radius:16px;
            border:1px solid rgba(245,158,11,.35);
            background:linear-gradient(135deg,rgba(51,33,8,.45),rgba(28,30,10,.35));
            padding:14px 16px;
            color:#fef3c7;
            font-style:italic;
        }

        @keyframes spin{
            to{transform:rotate(360deg);}
        }

        @keyframes spin-reverse{
            to{transform:rotate(-360deg);}
        }

        @keyframes pulse{
            0%,100%{transform:scale(1);opacity:1;}
            50%{transform:scale(1.35);opacity:.55;}
        }

        @media (max-width:980px){
            .hero-grid{grid-template-columns:1fr;}
            .card{grid-column:span 6;}
            .split{grid-template-columns:1fr;}
        }

        @media (max-width:640px){
            .micro-stats{grid-template-columns:1fr;}
            .card{grid-column:span 12;}
            .hero-grid{padding:20px;}
            .hero{border-radius:20px;}
        }
    </style>
@endpush

@section('content')
    @php
        $goalPercent = $monthlyTarget > 0 ? min(100, round(($actualMonthEntries / $monthlyTarget) * 100)) : 0;
    @endphp

    <div class="home-shell">
        <section class="hero">
            <canvas id="hero-canvas"></canvas>
            <div class="hero-grid">
                <div>
                    <span class="kicker">Live Command Center</span>
                    <h1>Build momentum with a dashboard that feels alive.</h1>
                    <p>
                        Your productivity layer is now visual-first. Track streaks, performance, and focus health in one
                        motion-rich space.
                    </p>

                    <div class="micro-stats">
                        <div class="pill">
                            <div class="label">Current Streak</div>
                            <div class="value">{{ $currentStreak }} day{{ $currentStreak === 1 ? '' : 's' }}</div>
                        </div>
                        <div class="pill">
                            <div class="label">Best Streak</div>
                            <div class="value">{{ $bestStreak }} day{{ $bestStreak === 1 ? '' : 's' }}</div>
                        </div>
                        <div class="pill">
                            <div class="label">Monthly Goal</div>
                            <div class="value">{{ $goalPercent }}%</div>
                        </div>
                    </div>
                </div>

                <div class="visual">
                    <div class="orbit one"></div>
                    <div class="orbit two"></div>
                    <div class="score-ring" style="--score: {{ $productivityScore }};"></div>
                    <div class="score-content">
                        <div class="big">{{ $productivityScore }}%</div>
                        <div class="small">Productivity</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid">
            <article class="card">
                <h3>Managers</h3>
                <div class="big">{{ $details['totalManagers'] }}</div>
                <div>{{ $details['activeManagers'] }} active</div>
            </article>

            <article class="card">
                <h3>Tasks</h3>
                <div class="big">{{ $details['totalTasks'] }}</div>
                <div>{{ $details['activeTasks'] }} active</div>
            </article>

            <article class="card">
                <h3>Entries Logged</h3>
                <div class="big">{{ $details['totalEntries'] }}</div>
                <div>{{ $details['totalTags'] }} tags in system</div>
            </article>

            <article class="card">
                <h3>7 Day Progress</h3>
                <div class="big">{{ round($progress7Percent) }}%</div>
                <div class="bar"><span style="width: {{ round($progress7Percent) }}%"></span></div>
            </article>

            <article class="card">
                <h3>30 Day Progress</h3>
                <div class="big">{{ round($progress30Percent) }}%</div>
                <div class="bar"><span style="width: {{ round($progress30Percent) }}%"></span></div>
            </article>

            <article class="card">
                <h3>Favorite Work Zone</h3>
                @if($favoriteManager)
                    <div class="big">{{ $favoriteManager->name }}</div>
                    <div>{{ $favoriteManagerEntries }} entries from this manager</div>
                @else
                    <div>No manager data yet.</div>
                @endif
            </article>
        </section>

        <section class="split">
            <article class="panel">
                <h2>Missed Tasks</h2>
                <div class="task-list">
                    @forelse($missedTasks as $task)
                        @php
                            $todaySum = $task->entries->where('entry_date', today())->sum('actual_value');
                            $remaining = $task->daily_target - $todaySum;
                        @endphp
                        <div class="task-item">
                            <div class="name">{{ $task->name }}</div>
                            <div class="meta">
                                {{ $remaining }} {{ $task->unit_type }} left today ({{ $todaySum }} / {{ $task->daily_target }})
                            </div>
                        </div>
                    @empty
                        <div class="task-item" style="border-color:rgba(34,197,94,.35);background:rgba(7,35,22,.26);">
                            <div class="name" style="color:#86efac;">No misses today.</div>
                            <div class="meta" style="color:#bbf7d0;">You hit every target so far.</div>
                        </div>
                    @endforelse
                </div>
            </article>

            <article class="panel">
                <h2>Recent Activity</h2>
                <div class="timeline">
                    @forelse($recentEntries as $entry)
                        <div class="timeline-item">
                            <span class="dot"></span>
                            <p>
                                <strong>{{ $entry->entry_date->format('M d, Y') }}</strong> logged
                                <strong>{{ $entry->actual_value }} {{ $entry->task->unit_type }}</strong> for
                                <strong>{{ $entry->task->name }}</strong>.
                            </p>
                        </div>
                    @empty
                        <div class="timeline-item">
                            <span class="dot"></span>
                            <p>No recent activity yet.</p>
                        </div>
                    @endforelse
                </div>
            </article>
        </section>

        <section class="panel">
            <h2>Monthly Goal Runway</h2>
            <div class="goal">
                Target: <strong>{{ $monthlyTarget }}</strong> |
                Completed: <strong>{{ $actualMonthEntries }}</strong> |
                Progress: <strong>{{ $goalPercent }}%</strong>
                <div class="bar" style="margin-top:12px;"><span style="width: {{ $goalPercent }}%"></span></div>
            </div>
        </section>
        <section class="quote">
            "{{ $quoteOfTheDay }}"
        </section>

        <section class="panel">
            <h2>About Us</h2>
            <p class="text">
                TaskPlannerM started as a study-driven project to practice modern web development and software
                engineering. It evolved into a practical productivity tool focused on daily structure, consistent
                tracking, and long-term progress through simple workflows.
            </p>
        </section>
    </div>

    <script>
        (function () {
            const canvas = document.getElementById('hero-canvas');
            if (!canvas) return;

            const ctx = canvas.getContext('2d');
            let particles = [];
            let w = 0;
            let h = 0;

            function resize() {
                const ratio = window.devicePixelRatio || 1;
                w = canvas.clientWidth;
                h = canvas.clientHeight;
                canvas.width = Math.floor(w * ratio);
                canvas.height = Math.floor(h * ratio);
                ctx.setTransform(ratio, 0, 0, ratio, 0, 0);

                const count = Math.max(24, Math.floor((w * h) / 18000));
                particles = Array.from({ length: count }, () => ({
                    x: Math.random() * w,
                    y: Math.random() * h,
                    vx: (Math.random() - 0.5) * 0.45,
                    vy: (Math.random() - 0.5) * 0.45,
                    r: Math.random() * 1.9 + 0.6
                }));
            }

            function draw() {
                ctx.clearRect(0, 0, w, h);

                for (let i = 0; i < particles.length; i++) {
                    const p = particles[i];
                    p.x += p.vx;
                    p.y += p.vy;

                    if (p.x < 0 || p.x > w) p.vx *= -1;
                    if (p.y < 0 || p.y > h) p.vy *= -1;

                    ctx.beginPath();
                    ctx.fillStyle = 'rgba(186,230,253,.72)';
                    ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                    ctx.fill();

                    for (let j = i + 1; j < particles.length; j++) {
                        const q = particles[j];
                        const dx = p.x - q.x;
                        const dy = p.y - q.y;
                        const d = Math.hypot(dx, dy);
                        if (d < 95) {
                            ctx.beginPath();
                            ctx.strokeStyle = 'rgba(45,212,191,' + (1 - d / 95) * 0.22 + ')';
                            ctx.lineWidth = 1;
                            ctx.moveTo(p.x, p.y);
                            ctx.lineTo(q.x, q.y);
                            ctx.stroke();
                        }
                    }
                }

                requestAnimationFrame(draw);
            }

            resize();
            draw();
            window.addEventListener('resize', resize);
        })();
    </script>
@endsection
