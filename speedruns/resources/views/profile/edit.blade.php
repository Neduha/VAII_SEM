@extends('app')

@section('title', 'Edit Profile - SpeedRunsHub')

@section('page-title', 'Edit Profile')

@section('content')
    <div class="auth-container">

            <div class="form-group">
                <h3>Update Profile Information</h3>
                <form method="POST" action="{{ route('profile.update') }}" class="auth-form" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required autofocus minlength="3" maxlength="15">
                        @error('name')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                        @error('email')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="profile_photo" class="form-label">Profile Photo</label>
                        <input type="file" id="profile_photo" name="profile_photo" class="form-input">
                        @error('profile_photo')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn">Save Changes</button>
                    </div>
                </form>
            </div>

        <hr class="divider">


        <div class="form-group">
            <h3>Update Password</h3>
            <form method="POST" action="{{ route('password.update') }}" class="auth-form">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input id="current_password" type="password" name="current_password" class="form-input" required>
                    @error('current_password', 'updatePassword')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">New Password</label>
                    <input id="password" type="password" name="password" class="form-input" required>
                    @error('password', 'updatePassword')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-input" required>
                    @error('password_confirmation', 'updatePassword')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn">Save Password</button>
                </div>
            </form>
        </div>

        <hr class="divider">


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
