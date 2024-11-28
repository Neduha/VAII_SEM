@extends('app')

@section('title', 'Settings - SpeedRunsHub')

@section('page-title', 'Settings')

@section('nav-buttons')
    <button class="btn" onclick="location.href='{{ route('home') }}'">Home</button>
    <button class="btn" onclick="location.href='{{ route('games') }}'">Games</button>

@endsection

@section('content')
    <div class="auth-container">
        <h2 class="page-title">Theme Settings</h2>
        <form id="theme-form" class="theme-form">
            <div class="form-group">
                <label class="theme-option">
                    <input type="radio" name="theme" value="default" checked>
                    Orange-Blue (Default)
                </label>
            </div>
            <div class="form-group">
                <label class="theme-option">
                    <input type="radio" name="theme" value="green">
                    Green
                </label>
            </div>
            <div class="form-group">
                <label class="theme-option">
                    <input type="radio" name="theme" value="purple">
                    Purple-Blue
                </label>
            </div>

        </form>
        <button id="save-theme-btn" class="btn btn-save">Save Theme</button>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const themeForm = document.getElementById('theme-form');
            const themeRadios = themeForm.querySelectorAll('input[name="theme"]');
            const saveThemeBtn = document.getElementById('save-theme-btn');
            const savedTheme = localStorage.getItem('theme');

            if (savedTheme) {
                document.documentElement.setAttribute('data-theme', savedTheme);
                themeRadios.forEach(radio => {
                    if (radio.value === savedTheme) {
                        radio.checked = true;
                    }
                });
            }

            saveThemeBtn.addEventListener('click', () => {
                const selectedTheme = themeForm.querySelector('input[name="theme"]:checked').value;
                document.documentElement.setAttribute('data-theme', selectedTheme);
                localStorage.setItem('theme', selectedTheme);

            });
        });
    </script>
@endsection
