@extends('app')

@section('title', $game->name . ' - Game Details')

@section('page-title', $game->name)

@section('nav-buttons')
    <button class="btn" onclick="location.href='{{ route('profile.view') }}'">Profile</button>
    <button class="btn" onclick="location.href='{{ route('settings') }}'">Settings</button>
    <button class="btn" onclick="location.href='{{ route('games.index') }}'">Games</button>
@endsection

@section('content')
    <div class="game-details-container" style="text-align: center; padding: 20px;">
        <img src="{{ $game->image }}" alt="{{ $game->name }}" style="max-width: 100%; height: auto; border-radius: 10px; margin-bottom: 20px;">

        <h2>{{ $game->name }}</h2>
        <h3><strong>Speedrun Count:<strong {{ $game->speedruns->count() }}</h3>
        <p><strong>Developer:</strong> {{ $game->developer }}</p>
        <p><strong>Release Date:</strong> {{ $game->release_date }}</p>
        <p><strong>Description:</strong> {{ $game->description }}</p>
        <p><strong>Total Speedruns:</strong> {{ $speedrunCount }}</p>

        <div style="margin-top: 20px;">
            <button class="btn" onclick="location.href='{{ route('games.index') }}'">Back to Games</button>
        </div>
    </div>
@endsection
