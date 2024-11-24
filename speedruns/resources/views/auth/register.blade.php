@extends('app')

@section('title', 'Register - SpeedRunsHub')

@section('page-title', 'Register')

@section('nav-buttons')
    <button class="btn" onclick="location.href='{{ route('login') }}'">Login</button>
    <button class="btn" onclick="location.href='{{ route('home') }}'">Home</button>
@endsection

@section('content')
    <div class="auth-container">
        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input id="name" type="text" name="name" class="form-input" value="{{ old('name') }}" required autofocus>
                @error('name')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" class="form-input" value="{{ old('email') }}" required>
                @error('email')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" class="form-input" required>
                @error('password')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-input" required>
                @error('password_confirmation')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit -->
            <div class="form-group">
                <button type="submit" class="btn">Register</button>
            </div>

            <!-- Redirect to Login -->
            <div class="form-group">
                <a href="{{ route('login') }}" class="link">Already registered?</a>
            </div>
        </form>
    </div>
@endsection
