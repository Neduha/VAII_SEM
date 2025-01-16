@extends('app')

@section('title', 'Speedruns to Verify')

@section('page-title', 'Speedruns to Verify')

@section('content')
    <div class="admin-unverified" style="text-align: center;">
        <h3 style="text-align: center; margin-bottom: 30px;">Unverified Speedruns</h3>
        @if($unverifiedSpeedruns->isEmpty())
            <p>No unverified speedruns at the moment.</p>
        @else
            <ul class="speedrun-list" style="list-style: none; padding: 0;">
                @foreach($unverifiedSpeedruns as $speedrun)
                    <li class="speedrun-item" style="margin-bottom: 40px; padding: 20px; border: 2px solid rgba(255, 255, 255, 0.5); border-radius: 10px; display: flex; flex-direction: column; position: relative; min-width: 500px;  background-color: rgba(0, 0, 0, 0.7); color: white; max-width: 700px; text-align: left;">

                        <div style="display: flex; align-items: center; margin-bottom: 10px;">
                            @if($speedrun->user->profile_photo)
                                <img src="{{ asset('storage/' . $speedrun->user->profile_photo) }}" alt="User Photo" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-right: 20px;">
                            @else
                                <img src="{{ asset('default-profile.png') }}" alt="Default User Photo" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-right: 20px;">
                            @endif
                            <p><strong>By:</strong> {{ $speedrun->user->name }}</p>
                        </div>

                        <div style="flex: 1; width: 100%;">
                            <strong>Game:</strong> {{ $speedrun->game_name ?? 'N/A' }}<br>
                            <strong>Category:</strong> {{ $speedrun->category->name ?? 'Unknown Category' }}<br>
                            <strong>Time:</strong> {{ gmdate('H:i:s', $speedrun->run_time) }}<br>
                            <strong>Date:</strong> {{ $speedrun->date ?? 'N/A' }}<br>
                            <strong>Description:</strong>
                            <p style="word-wrap: break-word; overflow-wrap: break-word; display: block; max-width: 100%; margin-top: 10px; white-space: normal;">
                                {{ $speedrun->description ?? 'No description' }}
                            </p>
                        </div>

                        <form method="POST" action="{{ route('admin.speedruns.verify', $speedrun->id) }}" style="position: absolute; bottom: 20px; right: 20px;">
                            @csrf
                            <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
