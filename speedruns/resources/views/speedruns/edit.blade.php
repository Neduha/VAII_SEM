@extends('app')

@section('title', 'Update Speedrun')

@section('page-title', 'Update Speedrun')

@section('content')
    <div class="auth-container">
        <h3>Update Speedrun</h3>
        <form method="POST" action="{{ route('speedruns.update', $speedrun->id) }}">
            @csrf
            @method('PUT')
            <div>
                <label for="game_id">Game</label>
                <select name="game_id" id="game_id" required>
                    @foreach($games as $game)
                        <option value="{{ $game->id }}" {{ old('game_id', $speedrun->game_id ?? '') == $game->id ? 'selected' : '' }}>
                            {{ $game->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $speedrun->category_id ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="run_time">Run Time (in seconds):</label>
                <input type="number" id="run_time" name="run_time" value="{{ $speedrun->run_time }}" required>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" value="{{ $speedrun->date }}" required>
            </div>
            <div class="form-group">
                <label for="video_url">Video URL:</label>
                <input type="url" id="video_url" name="video_url" value="{{ $speedrun->video_url }}">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description">{{ $speedrun->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="verified_status">Verified:</label>
                <select id="verified_status" name="verified_status">
                    <option value="1" {{ $speedrun->verified_status ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$speedrun->verified_status ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <button type="submit" class="btn">Save Changes</button>
        </form>
    </div>
@endsection
