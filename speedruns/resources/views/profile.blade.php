@extends('app')

@section('title', 'Profile - SpeedRunsHub')

@section('page-title', 'Profile')

@section('content')
    <div class="auth-container">
        <div class="profile-photo-container" style="text-align: center; margin-bottom: 20px;">
            @if($user->profile_photo)
                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" class="profile-photo-img">
            @else
                <img src="{{ asset('default-profile.png') }}" alt="Default Profile Photo" class="profile-photo-img">
            @endif
        </div>

        <h3>Your Profile</h3>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>

        <div class="form-group">
            <a href="{{ route('profile.edit') }}" class="btn">Edit Profile</a>
        </div>
    </div>

    <hr class="divider">

    <div class="darkened-container">
        <h3>Your Speedruns</h3>

        <div class="form-group" style="text-align: center; margin-top: 20px; margin-bottom: 20px;">
            <a href="{{ route('speedruns.create') }}" class="btn">Create New Speedrun</a>
        </div>

        <div class="filter-container" style="display: flex; justify-content: center; gap: 10px; margin-bottom: 20px;">
            <select id="game_filter" class="form-control">
                <option value="">Select Game</option>
                @foreach($games as $game)
                    <option value="{{ $game->id }}">{{ $game->name }}</option>
                @endforeach
            </select>
            <select id="category_filter" class="form-control">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div id="speedrun_list" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const gameFilter = document.getElementById('game_filter');
            const categoryFilter = document.getElementById('category_filter');
            const speedrunList = document.getElementById('speedrun_list');

            function fetchSpeedruns() {
                const gameId = gameFilter.value;
                const categoryId = categoryFilter.value;
                const url = `{{ route('profile.speedruns.filter') }}?game_id=${gameId}&category_id=${categoryId}`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        const runs = data.speedruns;
                        speedrunList.innerHTML = '';
                        if (runs.length === 0) {
                            speedrunList.innerHTML = '<p>No speedruns found.</p>';
                            return;
                        }
                        runs.forEach(speedrun => {
                            const runCard = `
                            <div class="speedrun-card" style="background-color: rgba(0, 0, 0, 0.7); padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); color: white;">
                                <div>
                                    <strong>Game:</strong> ${speedrun.game_name || 'N/A'}<br>
                                    <strong>Category:</strong> ${speedrun.category_name || 'Unknown Category'}<br>
                                    <strong>Time:</strong> ${speedrun.run_time || 'N/A'}<br>
                                    <strong>Date:</strong> ${speedrun.date || 'N/A'}<br>
                                    <strong>Description:</strong>
                                    <div class="speedrun-description" style="word-wrap: break-word; overflow-wrap: break-word; white-space: normal; max-width: 100%;">
                                        ${speedrun.description || 'No description'}
                                    </div>
                                    <strong>Verified:</strong> ${speedrun.verified_status ? 'Yes' : 'No'}
                                </div>
                                <div style="margin-top: 20px; display: flex; justify-content: space-between;">
                                    <form method="POST" action="${speedrun.delete_route}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-delete">Delete</button>
                                    </form>
                                    <a href="${speedrun.update_route}" class="btn">Update</a>
                                </div>
                            </div>`;
                            speedrunList.innerHTML += runCard;
                        });
                    })
                    .catch(error => console.error('Error fetching speedruns:', error));
            }

            gameFilter.addEventListener('change', fetchSpeedruns);
            categoryFilter.addEventListener('change', fetchSpeedruns);

            fetchSpeedruns();
        });
    </script>
@endsection
