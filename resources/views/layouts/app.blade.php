<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TaskPlannerM')</title>

    <style>
        html, body{
            margin:0;
            padding:0;
            background:#0f172a;
            color:#e5e7eb;
            font-family:Arial, sans-serif;
            min-height:100%;
        }

        a{
            color:inherit;
        }

        main{
            max-width:1200px;
            margin:0 auto;
            padding:24px;
        }

        hr{
            border:none;
            border-top:1px solid rgba(255,255,255,0.08);
        }
    </style>
    @stack('styles')
</head>
<body>

@include('layouts.header')

<main>
    @yield('content')
    {{ $slot ?? '' }}
</main>

@include('layouts.footer')

</body>
</html>
