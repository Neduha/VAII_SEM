@extends('app')

@section('title', 'Edit Profile - SpeedRunsHub')

@section('page-title', 'Edit Profile')

@section('content')
    <div class="auth-container">
        <!-- Update Profile Information -->
        <div class="form-group">
            <h3>Update Profile Information</h3>
            <form method="POST" action="{{ route('profile.update') }}" class="auth-form">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required autofocus>
                    @error('name')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn">Save Changes</button>
                </div>
            </form>
        </div>

        <hr class="divider">

        <!-- Update Password -->
        <div class="form-group">
            <h3>Update Password</h3>
            <form method="POST" action="{{ route('password.update') }}" class="auth-form">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input id="current_password" type="password" name="current_password" class="form-input" required>
                    @error('current_password')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">New Password</label>
                    <input id="password" type="password" name="password" class="form-input" required>
                    @error('password')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-input" required>
                    @error('password_confirmation')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn">Save Password</button>
                </div>
            </form>
        </div>

        <hr class="divider">

        <!-- Delete User -->
        <div class="form-group">
            <h3>Delete Account</h3>
            <form method="POST" action="{{ route('profile.destroy') }}" class="auth-form">
                @csrf
                @method('delete')

                <p class="text-warning">Once you delete your account, there is NO going back. Please be certain.</p>

                <div class="form-group">
                    <button type="submit" class="btn btn-delete">Delete Account</button>
                </div>
            </form>
        </div>
    </div>
@endsection
