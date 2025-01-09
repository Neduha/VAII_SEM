@extends('app')

@section('title', $game->name . ' - Game Details')

@section('page-title', $game->name)

@section('nav-buttons')
    <button class="btn" onclick="location.href='{{ route('profile.view') }}'">Profile</button>
    <button class="btn" onclick="location.href='{{ route('settings') }}'">Settings</button>
    <button class="btn" onclick="location.href='{{ route('games.index') }}'">Games</button>
@endsection

@section('content')
    <div style="display: flex; gap: 20px; padding: 20px;">

        <div style="width: 40%; text-align: left; padding: 20px;">
            <img src="{{ $game->image }}" alt="{{ $game->name }}" style="max-width: 100%; height: auto; border-radius: 10px; margin-bottom: 20px;">
            <h2>{{ $game->name }}</h2>
            <p><strong>Developer:</strong> {{ $game->developer }}</p>
            <p><strong>Release Date:</strong> {{ $game->release_date }}</p>
            <p><strong>Description:</strong> {{ $game->description }}</p>
            <p><strong>Total Speedruns:</strong> {{ $speedrunCount }}</p>
        </div>

        <div style="width: 60%; text-align: left; padding: 20px; background-color: rgba(0, 0, 0, 0.8); border-radius: 10px; color: #fff;">

            <div style="margin-bottom: 20px; display: flex; gap: 10px;">
                @foreach($categories as $category)
                    <button class="btn" onclick="filterSpeedruns('{{ $category->name }}')">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <h3 id="category-title" style="font-size: 24px; margin-bottom: 20px;">Speedruns for category: Any%</h3>

            <div style="margin-top: 20px;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                    <tr style="background-color: rgba(255, 255, 255, 0.1);">
                        <th style="padding: 10px; border-bottom: 3px solid #444;">Place</th>
                        <th style="padding: 10px; border-bottom: 3px solid #444;">User</th>
                        <th style="padding: 10px; border-bottom: 3px solid #444;">Date</th>
                        <th style="padding: 10px; border-bottom: 3px solid #444;">Time</th>
                        <th style="padding: 10px; border-bottom: 3px solid #444;">Verified</th>
                    </tr>
                    </thead>
                    <tbody id="speedrun-tbody">
                    @foreach ($speedruns as $index => $speedrun)
                        <tr style="border: 2px solid #444; background-color: rgba(255, 255, 255, 0.05);">
                            <td style="padding: 10px;">{{ $index + 1 }}</td>
                            <td style="padding: 10px;">{{ $speedrun->user->name }}</td>
                            <td style="padding: 10px;">{{ $speedrun->date }}</td>
                            <td style="padding: 10px;">{{ gmdate('H:i:s', $speedrun->run_time) }}</td>
                            <td style="padding: 10px;">{{ $speedrun->verified_status ? 'Yes' : 'No' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function filterSpeedruns(categoryName) {
            fetch(`/games/{{ $game->id }}/speedruns?category=${categoryName}`)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('speedrun-tbody');
                    tbody.innerHTML = '';

                    data.forEach((speedrun, index) => {
                        const row = `
                        <tr style="border: 2px solid #444; background-color: rgba(255, 255, 255, 0.05);">
                            <td style="padding: 10px;">${index + 1}</td>
                            <td style="padding: 10px;">${speedrun.user_name}</td>
                            <td style="padding: 10px;">${speedrun.date}</td>
                            <td style="padding: 10px;">${speedrun.run_time}</td>
                            <td style="padding: 10px;">${speedrun.verified ? 'Yes' : 'No'}</td>
                        </tr>
                    `;
                        tbody.innerHTML += row;
                    });

                    document.getElementById('category-title').innerText = `Speedruns for category: ${categoryName}`;
                })
                .catch(error => console.error('Error fetching speedruns:', error));
        }
    </script>
@endsection
