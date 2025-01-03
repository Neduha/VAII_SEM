@extends('app')

@section('title', 'Home - SpeedRunsHub')

@section('page-title', 'Home')

@section('nav-buttons')
    <button class="btn" onclick="location.href='{{ route('profile.view') }}'">Profile</button>
    <button class="btn" onclick="location.href='{{ route('settings') }}'">Settings</button>
    <button class="btn" onclick="location.href='{{ route('games.index') }}'">Games</button>
@endsection

@section('content')
    <div class="center-text">
        <h2>Welcome to the Hub</h2>
    </div>
@endsection
