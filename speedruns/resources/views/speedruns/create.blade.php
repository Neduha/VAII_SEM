@extends('app')

@section('title', 'Create Speedrun')

@section('page-title', 'Create a New Speedrun')

@section('content')
    <div class="auth-container">
        <h3>Create a New Speedrun</h3>
        <form method="POST" action="{{ route('speedruns.store') }}">
            @csrf
            <div class="form-group">
                <label for="game_name">Game Name:</label>
                <input type="text" id="game_name" name="game_name" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" id="category" name="category" required>
            </div>
            <div class="form-group">
                <label for="run_time">Run Time (in seconds):</label>
                <input type="number" id="run_time" name="run_time" required>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="video_url">Video URL:</label>
                <input type="url" id="video_url" name="video_url">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" required>
            </div>
            <button type="submit" class="btn">Submit Speedrun</button>
        </form>

    </div>
@endsection
