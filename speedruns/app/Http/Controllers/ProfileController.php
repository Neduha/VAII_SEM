<?php




namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Game;
use App\Models\Category;

class ProfileController extends Controller
{
    public function view(Request $request)
    {
        return view('profile', [
            'user' => $request->user(),
            'games' => Game::all(),
            'categories' => Category::all(),
        ]);
    }


    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $path = $file->store('profile_photos', 'public');

            $data['profile_photo'] = $path;

            if ($request->user()->profile_photo) {
                Storage::disk('public')->delete($request->user()->profile_photo);
            }
        }

        $request->user()->fill($data);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function filterSpeedruns(Request $request)
    {
        $gameId = $request->query('game_id');
        $categoryId = $request->query('category_id');
        $user = auth()->user();

        $query = $user->speedruns();

        if ($gameId) {
            $query->where('game_id', $gameId);
        }
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $speedruns = $query->orderBy('created_at', 'desc')->take(10)->get();

        $mapped = $speedruns->map(function ($speedrun) {
            return [
                'id'             => $speedrun->id,
                'game_name'      => $speedrun->game_name ?? 'N/A',
                'category_name'  => $speedrun->category->name ?? 'Unknown Category',
                'run_time'       => gmdate('H:i:s', $speedrun->run_time),
                'date'           => $speedrun->date ?? 'N/A',
                'description'    => $speedrun->description ?? 'No description',
                'verified_status'=> $speedrun->verified_status,
                'delete_route'   => route('speedruns.destroy', $speedrun->id),
                'update_route'   => route('speedruns.edit', $speedrun->id),
            ];
        });

        return response()->json(['speedruns' => $mapped]);
    }


}
