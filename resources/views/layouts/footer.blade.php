<style>

    .site-footer{
        margin-top:50px;
        padding:32px 20px;
        border-top:1px solid #1f2937;
        background:linear-gradient(135deg,#0b1220,#111827,#1e1b4b);
        box-shadow:0 -8px 30px rgba(0,0,0,0.35);
    }

    .footer-content{
        max-width:900px;
        margin:auto;
        text-align:center;
    }

    .footer-brand{
        font-size:24px;
        font-weight:800;
        letter-spacing:-0.5px;
        color:#f8fafc;
        margin-bottom:10px;
        display:inline-block;
        position:relative;
    }

    .footer-brand::after{
        content:'';
        display:block;
        width:70%;
        height:4px;
        margin:8px auto 0;
        border-radius:999px;
        background:linear-gradient(90deg,#3b82f6,#8b5cf6);
        box-shadow:0 0 14px rgba(59,130,246,0.35);
    }

    .footer-text{
        margin:14px 0 10px 0;
        color:#cbd5e1;
        font-size:15px;
    }

    .footer-copy{
        margin:0;
        color:#94a3b8;
        font-size:13px;
    }

</style>


<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-brand">TaskPlannerM</div>
        <p class="footer-text">Track tasks, measure progress, and stay consistent every day.</p>
        <p class="footer-copy">© {{ date('Y') }} TaskPlannerM. All rights reserved.</p>
    </div>
</footer>
