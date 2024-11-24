@extends('app')

@section('title', 'Profile - SpeedRunsHub')

@section('page-title', 'Profile')

@section('content')
    <div class="auth-container">
        <h2>Welcome, {{ Auth::user()->name }}</h2>
        <p>Email: {{ Auth::user()->email }}</p>

        <div class="form-group">
            <button class="btn" onclick="location.href='{{ route('profile.edit') }}'">Edit Profile Information</button>
        </div>
    </div>
@endsection
