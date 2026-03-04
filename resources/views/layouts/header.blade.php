<header>
    <nav>
        <a href="{{ route('home') }}">Home</a>
        |
        <a href="{{ route('office.index') }}">Office</a>
        |
        <a href="{{ route('appsettings') }}">Settings</a>
        |
        <a href="{{ route('news') }}">News</a>

        <span style="margin-left: 20px;">
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </span>
    </nav>
    <hr>
</header>
