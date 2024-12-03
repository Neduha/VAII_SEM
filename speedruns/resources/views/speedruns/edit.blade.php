@extends('app')

@section('title', 'Update Speedrun')

@section('page-title', 'Update Speedrun')

@section('content')
    <div class="auth-container">
        <h3>Update Speedrun</h3>
        <form method="POST" action="{{ route('speedruns.update', $speedrun->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="game_name">Game Name:</label>
                <input type="text" id="game_name" name="game_name" value="{{ $speedrun->game_name }}" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" id="category" name="category" value="{{ $speedrun->category }}" required>
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
