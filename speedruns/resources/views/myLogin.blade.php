@extends('app')

@section('page-title', 'Login')

@section('nav-buttons')

    <button class="btn" onclick="location.href='{{ route('games') }}'">Games</button>
    <button class="btn" onclick="location.href='{{ route('notImplemented') }}'">Settings</button>
    <button class="btn" onclick="location.href='{{ route('notImplemented') }}'">Profile</button>
@endsection

@section('content')
    <div class="darkened-container">
        <div class="login-box">
            <h2>Log In</h2>
            <form method="POST" action="{{ route('notImplemented') }}">
                @csrf

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required placeholder="Enter your username">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="Enter your password">
                </div>


                <button type="submit" class="btn-login">Log In</button>
            </form>
        </div>
    </div>
@endsection
