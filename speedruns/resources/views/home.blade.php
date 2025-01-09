@extends('app')

@section('title', 'Home - SpeedRunsHub')

@section('page-title', 'Home')

@section('nav-buttons')
    <button class="btn" onclick="location.href='{{ route('profile.view') }}'">Profile</button>
    <button class="btn" onclick="location.href='{{ route('settings') }}'">Settings</button>
    <button class="btn" onclick="location.href='{{ route('games.index') }}'">Games</button>
@endsection

@section('content')
    <div class="admin-unverified" style="text-align: center;">
        <h3 style="text-align: center; margin-bottom: 30px;">Most Recent Speedruns</h3>
        <div id="recent-speedruns">
            <p>Loading recent speedruns...</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fetchSpeedruns = () => {
                fetch('/speedruns/recent')
                    .then(response => response.json())
                    .then(data => {
                        const container = document.getElementById('recent-speedruns');
                        container.innerHTML = '';

                        if (data.speedruns.length === 0) {
                            container.innerHTML = '<p>No recent speedruns found.</p>';
                            return;
                        }

                        data.speedruns.forEach(speedrun => {
                            const runCard = `
                            <li class="speedrun-item" style="margin-bottom: 40px; padding: 20px; border: 1px solid rgba(255, 255, 255, 0.4); border-radius: 10px; display: flex; flex-direction: column; position: relative; min-height: 250px; background-color: rgba(0, 0, 0, 0.7); color: white; max-width: 600px; text-align: left;">

                                <div style="display: flex; align-items: center; margin-bottom: 10px;">
                                    <img src="${speedrun.user_photo}" alt="User Photo" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-right: 20px;">
                                    <p><strong>By:</strong> ${speedrun.user_name}</p>
                                </div>

                                <div style="flex: 1; width: 100%;">
                                    <strong>Game:</strong> ${speedrun.game_name}<br>
                                    <strong>Category:</strong> ${speedrun.category_name}<br>
                                    <strong>Time:</strong> ${speedrun.run_time}<br>
                                    <strong>Date:</strong> ${speedrun.date}<br>
                                    <strong>Description:</strong>
                                    <p style="word-wrap: break-word; overflow-wrap: break-word; display: block; max-width: 100%; margin-top: 10px; white-space: normal;">
                                        ${speedrun.description}
                                    </p>
                                </div>
                            </li>
                        `;
                            container.innerHTML += runCard;
                        });
                    })

            };

            fetchSpeedruns();

            setInterval(fetchSpeedruns, 5000);
        });
    </script>


@endsection
