@extends('app')

@section('title', 'Login - SpeedRunsHub')

@section('page-title', 'Login')

@section('nav-buttons')
    <button class="btn" onclick="location.href='{{ route('register') }}'">Register</button>
    <button class="btn" onclick="location.href='{{ route('home') }}'">Home</button>
@endsection

@section('content')
    <div class="auth-container">
        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" class="form-input" value="{{ old('email') }}" required autofocus>
                @error('email')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" class="form-input" required>
                @error('password')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="remember_me" class="form-checkbox">
                    <input type="checkbox" name="remember" id="remember_me">
                    <span>Remember Me</span>
                </label>
            </div>

            <div class="form-group">
                <button type="submit" class="btn">Login</button>
            </div>

            <div class="form-group">
                <a href="{{ route('password.request') }}" class="link">Forgot Password?</a>
            </div>
        </form>
    </div>
@endsection
