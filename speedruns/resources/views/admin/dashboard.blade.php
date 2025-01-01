@extends('app')

@section('title', 'Admin Dashboard')

@section('page-title', 'Admin Dashboard')

@section('content')
    <div class="admin-dashboard">
        <div class="right-section" style="text-align: center; margin-bottom: 40px;">
            <h3>Admin Actions</h3>
            <button class="btn" onclick="location.href='{{ route('admin.speedruns.unverified') }}'">Speedruns to Verify</button>
            <button class="btn" onclick="location.href='{{ route('speedruns.index') }}'">View All Speedruns</button>
            <button class="btn" onclick="location.href='{{ route('profile.view') }}'">Back to Profile</button>
        </div>
    </div>
@endsection
