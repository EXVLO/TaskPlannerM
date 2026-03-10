{{--
    Redesigned footer for TaskPlannerM with multiple columns and a clean dark theme.
    This footer includes links to important pages (Home, Office, Settings, News),
    additional informational links (About, Contact, Privacy Policy) and a GitHub link.
    To use it, replace the contents of `resources/views/layouts/footer.blade.php`
    with this file.
--}}

<style>
    .footer{
        background:#111827;
        padding:40px 20px;
        border-top:1px solid rgba(255,255,255,0.08);
        box-shadow:0 -8px 24px rgba(0,0,0,0.35);
    }
    .footer .footer-container{
        max-width:1200px;
        margin:0 auto;
        display:flex;
        flex-wrap:wrap;
        gap:32px;
        justify-content:space-between;
    }
    .footer-col{
        flex:1 1 200px;
        min-width:160px;
    }
    .footer-col h3{
        color:#f1f5f9;
        margin-bottom:12px;
        font-size:1.1rem;
    }
    .footer-col ul{
        list-style:none;
        margin:0;
        padding:0;
    }
    .footer-col li{
        margin-bottom:8px;
    }
    .footer-col a{
        color:#94a3b8;
        font-size:0.9rem;
        text-decoration:none;
        transition:color 0.2s ease;
    }
    .footer-col a:hover{
        color:#8b5cf6;
    }
    .footer-bottom{
        text-align:center;
        margin-top:20px;
        color:#64748b;
        font-size:0.8rem;
    }
    .footer-brand{
        font-size:1.5rem;
        font-weight:800;
        color:#f8fafc;
        margin-bottom:8px;
    }
    .footer-tagline{
        color:#94a3b8;
        font-size:0.9rem;
        margin-bottom:16px;
        max-width:300px;
    }
    @media (max-width: 768px){
        .footer .footer-container{
            flex-direction:column;
        }
        .footer-col{
            min-width:100%;
        }
    }
</style>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-col">
            <div class="footer-brand">TaskPlannerM</div>
            <div class="footer-tagline">Plan tasks, track your progress and achieve more every day.</div>
        </div>
        <div class="footer-col">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('office.index') }}">Office</a></li>
                <li><a href="{{ route('appsettings') }}">Settings</a></li>
                <li><a href="{{ route('news') }}">News</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h3>About</h3>
            <ul>
                <li><a href="#">Features</a></li>
                <li><a href="#">Pricing</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h3>Resources</h3>
            <ul>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="https://github.com/EXVLO/TaskPlannerM" target="_blank" rel="noopener">GitHub</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; {{ date('Y') }} TaskPlannerM. All rights reserved.
    </div>
</footer>
