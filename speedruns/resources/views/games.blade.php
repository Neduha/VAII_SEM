@extends('app')

@section('title', 'Games - SpeedRunsHub')

@section('page-title', 'Games')

@section('nav-buttons')
    <button class="btn" onclick="location.href='{{ route('profile.view') }}'">Profile</button>
    <button class="btn" onclick="location.href='{{ route('settings') }}'">Settings</button>
@endsection

@section('content')
    <div class="darkened-container games-container">
        <div class="games-grid">
            @foreach($games as $game)
                <div class="game-card">
                    <a href="{{ route('games.show', $game->id) }}" style="text-decoration: none; color: inherit;">
                        <img src="{{ $game->image }}" alt="{{ $game->name }}" style="max-width: 100%; height: auto;">
                        <h3>{{ $game->name }}</h3>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
@endsection
