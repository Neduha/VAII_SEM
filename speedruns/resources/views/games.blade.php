@extends('app')

@section('title', 'Games - SpeedRunsHub')

@section('page-title', 'Games')

@section('nav-buttons')
    <button class="btn" onclick="location.href='{{ route('profile.view') }}'">Profile</button>
    <button class="btn" onclick="location.href='{{ route('settings') }}'">Settings</button>
@endsection

@section('content')
    <div class="darkened-container games-container">
        <div style="text-align: center; margin-bottom: 20px;">
            <input type="text" id="search-box" placeholder="Search for games..."
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        </div>

        <div class="games-grid" id="games-container">
            @foreach($games as $game)
                <div class="game-card">
                    <a href="{{ route('games.show', $game->id) }}" style="text-decoration: none; color: inherit;">
                        <img src="{{ $game->image }}" alt="{{ $game->name }}" style="max-width: 100%; height: auto;">
                        <div class="game-card-content">
                            <div class="game-title">{{ $game->name }}</div>
                            <div class="game-info">Release Year: {{ \Carbon\Carbon::parse($game->release_date)->year }}</div>
                            <div class="game-info">Speedruns: {{ $game->speedruns->count() }}</div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchBox = document.getElementById('search-box');
            const gamesContainer = document.getElementById('games-container');
            let debounceTimeout = null;


            function updateGames(games) {
                gamesContainer.innerHTML = '';

                if (!games || games.length === 0) {
                    gamesContainer.innerHTML = '<p>No games found.</p>';
                    return;
                }

                games.forEach(game => {
                    const gameCard = `
                    <div class="game-card">
                        <a href="/games/${game.id}" style="text-decoration: none; color: inherit;">
                            <img src="${game.image}" alt="${game.name}" style="max-width: 100%; height: auto;">
                            <div class="game-card-content">
                                <div class="game-title">${game.name}</div>
                                <div class="game-info">Release Year: ${game.release_date}</div>
                                <div class="game-info">Speedruns: ${game.speedrun_count}</div>
                            </div>
                        </a>
                    </div>
                `;
                    gamesContainer.innerHTML += gameCard;
                });
            }


            function fetchGames(query) {
                fetch(`/games/search?query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => updateGames(data.games))
                    .catch(() => {
                        gamesContainer.innerHTML = '<p>Error loading games. Please try again later.</p>';
                    });
            }


            searchBox.addEventListener('input', function () {
                const query = searchBox.value.trim();

                clearTimeout(debounceTimeout);
                debounceTimeout = setTimeout(() => {
                    if (query.length === 0) {
                        updateGames({!! json_encode($games->map(function ($game) {
                        return [
                            'id' => $game->id,
                            'name' => $game->name,
                            'image' => $game->image,
                            'release_date' => \Carbon\Carbon::parse($game->release_date)->year,
                            'speedrun_count' => $game->speedruns->count(),
                        ];
                    })) !!});
                    } else {
                        fetchGames(query);
                    }
                }, 300);
            });
        });
    </script>


@endsection
