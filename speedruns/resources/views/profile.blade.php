@extends('app')

@section('title', 'Profile - SpeedRunsHub')

@section('page-title', 'Profile')

@section('content')
    <div class="auth-container">

        <div class="profile-photo-container" style="text-align: center; margin-bottom: 20px;">
            @if($user->profile_photo)
                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
            @else
                <img src="{{ asset('default-profile.png') }}" alt="Default Profile Photo" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
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

        <div class="form-group" style="text-align: center; margin-top: 20px; margin-bottom: 40px;">
            <a href="{{ route('speedruns.create') }}" class="btn">Create New Speedrun</a>
        </div>

        @if($user->speedruns->isEmpty())
            <p>You haven't uploaded any speedruns yet.</p>
        @else
            <ul class="speedrun-list">
                @foreach($user->speedruns as $speedrun)
                    <li class="speedrun-item" style="margin-bottom: 40px; padding: 20px; border: 1px solid rgba(255, 255, 255, 0.4); border-radius: 10px; background-color: #2c2c2c; display: flex; flex-direction: column; width: 500px; max-width: 100%; word-wrap: break-word;">

                        <div style="flex: 1; line-height: 1.6;">
                            <strong>Game:</strong> {{ $speedrun->game_name ?? 'N/A' }}<br>
                            <strong>Category:</strong> {{ $speedrun->category->name ?? 'Unknown Category' }}<br>
                            <strong>Time:</strong> {{ gmdate('H:i:s', $speedrun->run_time) }}<br>
                            <strong>Date:</strong> {{ $speedrun->date ?? 'N/A' }}<br>
                            <strong>Description:</strong>
                            <span style="display: inline;">{{ $speedrun->description ?? 'No description' }}</span><br>
                            <strong>Verified:</strong> {{ $speedrun->verified_status ? 'Yes' : 'No' }}
                        </div>

                        <div style="margin-top: 15px; display: flex; justify-content: space-between;">
                            <form method="POST" action="{{ route('speedruns.destroy', $speedrun->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">Delete</button>
                            </form>
                            <a href="{{ route('speedruns.edit', $speedrun->id) }}" class="btn">Update</a>
                        </div>
                    </li>


                @endforeach
            </ul>
        @endif
    </div>
@endsection
