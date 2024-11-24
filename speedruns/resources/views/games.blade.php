@extends('app')

@section('title', 'Games - SpeedRunsHub')

@section('page-title', 'Games')

@section('nav-buttons')
    <button class="btn" onclick="location.href='{{ route('notImplemented') }}'">Profile</button>
    <button class="btn" onclick="location.href='{{ route('notImplemented') }}'">Settings</button>
@endsection

@section('content')
    <div class="darkened-container games-container">
        <div class="games-grid">
            @for ($i = 1; $i <= 15; $i++)
                <div class="game-card">
                    <img src="https://via.placeholder.com/150" alt="Game {{ $i }}">
                    <h3>Game {{ $i }}</h3>
                </div>
            @endfor
        </div>
    </div>
@endsection
