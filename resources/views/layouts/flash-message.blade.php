@if(session('success'))
    <div id="flash-success" style="background:#052e16;color:#4ade80;border:1px solid #14532d;
         padding:12px 16px;border-radius:10px;margin:16px;font-weight:600;">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(function(){
            const msg=document.getElementById('flash-success');
            if(msg){
                msg.style.transition='opacity 0.5s';
                msg.style.opacity='0';
                setTimeout(function(){ msg.remove(); },500);
            }
        },2500);
    </script>
@endif

@if(session('error'))
    <div id="flash-error" style="background:#7f1d1d;color:#fecaca;border:1px solid #b91c1c;
         padding:12px 16px;border-radius:10px;margin:16px;font-weight:600;">
        {{ session('error') }}
    </div>
    <script>
        setTimeout(function(){
            const msg=document.getElementById('flash-error');
            if(msg){
                msg.style.transition='opacity 0.5s';
                msg.style.opacity='0';
                setTimeout(function(){ msg.remove(); },500);
            }
        },2500);
    </script>
@endif
