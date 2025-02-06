@extends('app')

@section('title', 'Admin Dashboard')

@section('page-title', 'Admin Dashboard')

@section('nav-buttons')
    <button class="btn" onclick="location.href='{{ route('profile.view') }}'">Profile</button>
    <button class="btn" onclick="location.href='{{ route('settings') }}'">Settings</button>
    <button class="btn" onclick="location.href='{{ route('games.index') }}'">Games</button>
@endsection

@section('content')
    <div class="admin-dashboard">
        <div class="right-section" style="text-align: center; margin-bottom: 40px;">
            <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">Admin Actions</h2>
            <div style="display: flex;  gap: 15px; align-items: center;">
                <button class="btn" onclick="location.href='{{ route('admin.speedruns.unverified') }}'">Speedruns to Verify</button>
                <button class="btn" onclick="location.href='{{ route('admin.users.index') }}'">View All Users</button>
                <button class="btn" onclick="location.href='{{ route('profile.view') }}'">Back to Profile</button>
                <button class="btn" onclick="location.href='{{ route('admin.games.create') }}'">Add New Game</button>
            </div>
        </div>
    </div>
@endsection
