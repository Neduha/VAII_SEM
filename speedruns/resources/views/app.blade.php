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
    </div>
    <div class="right-buttons">
        <button class="btn btn-login-out" onclick="location.href='{{ route('login') }}'">Log In</button>
    </div>
</header>

<div class="page-title">
    <h2>@yield('page-title', 'Welcome')</h2>
</div>

<div class="darkened-container">
    @yield('content')
</div>

</body>
</html>