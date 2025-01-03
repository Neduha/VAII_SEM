@extends('app')

@section('title', 'Dashboard - SpeedRunsHub')

@section('page-title', 'Dashboard')

@section('nav-buttons')
    <button class="btn" onclick="location.href='{{ route('profile.view') }}'">Profile</button>
    <button class="btn" onclick="location.href='{{ route('notImplemented') }}'">Settings</button>
    <button class="btn" onclick="location.href='{{ route('games.index') }}'">Games</button>
@endsection

@section('content')
    <div class="center-text">
        <h2>Welcome back to your Dashboard</h2>
    </div>
@endsection
