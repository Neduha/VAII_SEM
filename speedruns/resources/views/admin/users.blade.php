@extends('app')

@section('title', 'Admin Dashboard - Users')

@section('page-title', 'Admin Dashboard - View All Users')

@section('nav-buttons')
    <button class="btn" onclick="location.href='{{ route('profile.view') }}'">Profile</button>
    <button class="btn" onclick="location.href='{{ route('settings') }}'">Settings</button>
    <button class="btn" onclick="location.href='{{ route('games.index') }}'">Games</button>
@endsection

@section('content')
    <div class="auth-container">
        <h2>All Users</h2>
        <div style="text-align: center; margin-bottom: 20px;">
            <input type="text" id="user-search-box" placeholder="Search for users..." style="width: 100%; max-width: 500px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        </div>
        <div id="users-container" class="user-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
            @foreach($users as $user)
                <div class="user-card" style="background-color: rgba(0,0,0,0.7); padding: 20px; border-radius: 10px; color: white; box-shadow: 0 4px 8px rgba(0,0,0,0.2); border: 1px solid white;">
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Role:</strong> {{ $user->role ?? 'user' }}</p>
                    <div class="user-actions">
                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Delete</button>
                        </form>
                        @if($user->role !== 'admin')
                            <form method="POST" action="{{ route('admin.users.makeAdmin', $user->id) }}">
                                @csrf
                                <button type="submit" class="btn">Make Admin</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchBox = document.getElementById('user-search-box');
            const usersContainer = document.getElementById('users-container');
            let debounceTimeout = null;

            function updateUsers(users) {
                usersContainer.innerHTML = '';
                if (!users || users.length === 0) {
                    usersContainer.innerHTML = '<p>No users found.</p>';
                    return;
                }
                users.forEach(user => {
                    const makeAdminButton = user.role !== 'admin' ? `
                        <form method="POST" action="${user.make_admin_route}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn">Make Admin</button>
                        </form>
                    ` : '';

                    const userCard = `
                        <div class="user-card" style="background-color: rgba(0,0,0,0.7); padding: 20px; border-radius: 10px; color: white; box-shadow: 0 4px 8px rgba(0,0,0,0.2); border: 2px solid white;">
                            <p><strong>Name:</strong> ${user.name}</p>
                            <p><strong>Email:</strong> ${user.email}</p>
                            <p><strong>Role:</strong> ${user.role || 'user'}</p>
                            <div style="display: flex; justify-content: space-between; margin-top: 15px;">
                                <form method="POST" action="${user.delete_route}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-delete">Delete</button>
                                </form>
                                ${makeAdminButton}
                            </div>
                        </div>`;
                    usersContainer.innerHTML += userCard;
                });
            }

            function fetchUsers(query) {
                fetch(`/admin/users/search?query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => updateUsers(data.users))
                    .catch(() => {
                        usersContainer.innerHTML = '<p>Error loading users. Please try again later.</p>';
                    });
            }

            searchBox.addEventListener('input', function () {
                const query = searchBox.value.trim();
                clearTimeout(debounceTimeout);
                debounceTimeout = setTimeout(() => {
                    if (query.length === 0) {
                        updateUsers({!! json_encode($users->map(function($user) {
                            return [
                                'id' => $user->id,
                                'name' => $user->name,
                                'email' => $user->email,
                                'role' => $user->role,
                                'delete_route' => route('admin.users.destroy', $user->id),
                                'make_admin_route' => route('admin.users.makeAdmin', $user->id)
                            ];
                        })) !!});
                    } else {
                        fetchUsers(query);
                    }
                }, 300);
            });
        });
    </script>
@endsection
