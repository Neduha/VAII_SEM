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
            @foreach ($games as $game)
                <div class="game-card">
                    <img src="{{ $game->image }}" alt="{{ $game->name }}" style="width: 100%; height: auto; border-radius: 10px;">
                    <h3>{{ $game->name }}</h3>
                </div>
            @endforeach
        </div>
    </div>
@endsection
