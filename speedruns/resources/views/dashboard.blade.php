@extends('app')

@section('title', 'Dashboard - SpeedRunsHub')

@section('page-title', 'Dashboard')

@section('nav-buttons')
    <button class="btn" onclick="location.href='{{ route('profile.edit') }}'">Profile</button>
    <button class="btn" onclick="location.href='{{ route('notImplemented') }}'">Settings</button>
    <button class="btn" onclick="location.href='{{ route('games') }}'">Games</button>
@endsection

@section('content')
    <div class="center-text">
        <h2>Welcome back to your Dashboard</h2>
        <p>Here you can manage your account, view your progress, and much more!</p>
    </div>
@endsection
