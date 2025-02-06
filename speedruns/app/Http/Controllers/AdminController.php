<?php

namespace App\Http\Controllers;

use App\Models\Speedrun;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $unverifiedSpeedruns = Speedrun::where('verified_status', false)->get();
        return view('admin.dashboard', compact('unverifiedSpeedruns'));
    }

    public function verifySpeedrun(Speedrun $speedrun)
    {
        $speedrun->update(['verified_status' => true]);

        return redirect()->route('admin.speedruns.unverified')->with('success', 'Speedrun verified successfully!');
    }


    public function unverifiedSpeedruns()
    {
        $unverifiedSpeedruns = Speedrun::where('verified_status', false)->with('user')->get();

        return view('admin.unverified-speedruns', compact('unverifiedSpeedruns'));
    }

    public function searchUsers(Request $request)
    {
        $query = $request->query('query', '');
        if (empty($query)) {
            $users = User::all();
        } else {
            $users = User::where('name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->get();
        }
        $formattedUsers = $users->map(function($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'delete_route' => route('admin.users.destroy', $user->id),
                'make_admin_route' => route('admin.users.makeAdmin', $user->id)
            ];
        });
        return response()->json(['users' => $formattedUsers]);
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function makeAdmin(User $user)
    {
        $user->role = 'admin';
        $user->save();
        return redirect()->back()->with('success', 'User updated to admin.');
    }

    public function indexUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

}

