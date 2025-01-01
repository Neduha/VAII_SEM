<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpeedRunsHub</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<header class="top-bar">
    <div class="left-section">
        <a href="{{ route('home') }}" class="site-title">SpeedRunsHub</a>
        @yield('nav-buttons')
        @if(auth()->check() && auth()->user()->role === 'admin')
            <button class="btn" onclick="location.href='{{ route('admin.dashboard') }}'">Admin</button>
        @endif
    </div>
    <div class="right-buttons">
        @if (Auth::check())

            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-login-out">Log Out</button>
            </form>
        @else
            <button class="btn btn-login-out" onclick="location.href='{{ route('login') }}'">Log In</button>
            <button class="btn btn-login-out" onclick="location.href='{{ route('register') }}'">Sign Up</button>
        @endif
    </div>
</header>

<div class="page-title">
    <h2>@yield('page-title', 'Welcome')</h2>
</div>

<div class="darkened-container">
    @yield('content')
</div>

@yield('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('theme') || 'default';
        document.documentElement.setAttribute('data-theme', savedTheme);
    });
</script>
</body>
</html>
