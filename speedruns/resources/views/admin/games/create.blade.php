@extends('app')

@section('title', 'Create New Game')

@section('page-title', 'Create New Game')

@section('content')
    <div class="auth-container">
        <form method="POST" action="{{ route('admin.games.store') }}" enctype="multipart/form-data" class="auth-form">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Game Name</label>
                <input id="name" type="text" name="name" class="form-input" required autofocus>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <input id="description" name="description" class="form-input" required></input>
            </div>

            <div class="form-group">
                <label for="release_date" class="form-label">Release Date</label>
                <input id="release_date" type="date" name="release_date" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="developer" class="form-label">Developer</label>
                <input id="developer" type="text" name="developer" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Game Image URL</label>
                <input id="image" type="url" name="image" class="form-input" placeholder="https://example.com/image.jpg">
            </div>

            <div class="form-group">
                <button type="submit" class="btn">Create Game</button>
            </div>
        </form>
    </div>
@endsection
