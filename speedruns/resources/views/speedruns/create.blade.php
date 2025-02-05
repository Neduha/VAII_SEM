@extends('app')

@section('title', 'Create Speedrun')

@section('page-title', 'Create a New Speedrun')

@section('content')
    <div class="auth-container">
        <h3>Create a New Speedrun</h3>
        <form method="POST" action="{{ route('speedruns.store') }}">
            @csrf
            <div class="form-group">
                <label for="game_id">Game</label>
                <select name="game_id" id="game_id" required>
                    <option value="">Select a game</option>
                    @foreach($games as $game)
                        <option value="{{ $game->id }}" {{ old('game_id') == $game->id ? 'selected' : '' }}>
                            {{ $game->name }}
                        </option>
                    @endforeach
                </select>
                <span class="error-message"></span>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" required>
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <span class="error-message"></span>
            </div>

            <div class="form-group">
                <label for="run_time">Run Time (hours:minutes:seconds)</label>
                <input
                    type="text"
                    id="run_time"
                    name="run_time"
                    required
                    placeholder="00:00:00"
                    value="{{ old('run_time') }}"
                >
                <span class="error-message"></span>
            </div>

            <div class="form-group">
                <label for="date">Date</label>
                <input
                    type="date"
                    id="date"
                    name="date"
                    required
                    value="{{ old('date') }}"
                >
                <span class="error-message"></span>
            </div>

            <div class="form-group">
                <label for="video_url">Video URL</label>
                <input
                    type="url"
                    id="video_url"
                    name="video_url"
                    placeholder="Optional or valid URL"
                    value="{{ old('video_url') }}"
                >
                <span class="error-message"></span>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input
                    type="text"
                    id="description"
                    name="description"
                    required
                    placeholder="This field is required"
                    value="{{ old('description') }}"
                >
                <span class="error-message"></span>
            </div>

            <button type="submit" class="btn">Submit Speedrun</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fields = document.querySelectorAll('#game_id, #category_id, #run_time, #date, #video_url, #description');

            fields.forEach(field => {
                field.addEventListener('blur', () => {
                    if (field.required && !field.value.trim()) {
                        field.placeholder = field.id === 'run_time' ? '00:00:00' : 'This field is required';
                    }
                });

                field.addEventListener('input', () => {
                    field.placeholder = '';
                });

                field.addEventListener('change', () => validateField(field));
            });

            function validateField(field) {
                const value = field.value.trim();
                let error = '';

                if (field.required && !value) {
                    error = 'This field is required.';
                } else if (field.id === 'run_time' && !/^([0-9]{1,2}):([0-5][0-9]):([0-5][0-9])$/.test(value)) {
                    error = 'Run Time must be in HH:MM:SS format.';
                } else if (field.id === 'video_url' && value && !/^(https?:\/\/)?([\w\d\-]+\.)+[\w\d\-]+(\/.*)?$/.test(value)) {
                    error = 'Invalid URL.';
                } else if (field.id === 'description' && value.length > 1000) {
                    error = 'Description cannot exceed 1000 characters.';
                }

                const errorSpan = field.nextElementSibling;
                if (error) {
                    field.classList.add('is-invalid');
                    errorSpan.textContent = error;
                } else {
                    field.classList.remove('is-invalid');
                    errorSpan.textContent = '';
                }
            }

            document.querySelector('form').addEventListener('submit', function (e) {
                let invalidCount = 0;
                fields.forEach(field => {
                    validateField(field);
                    if (field.classList.contains('is-invalid')) {
                        invalidCount++;
                    }
                });
                if (invalidCount > 0) {
                    e.preventDefault();
                    alert('Please correct the errors before submitting.');
                }
            });
        });
    </script>
@endsection
