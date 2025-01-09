<?php

namespace App\Http\Controllers;

use App\Models\Speedrun;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Category;

class SpeedrunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function index()
    {
        $speedruns = Speedrun::all();
        return view('speedruns.index', compact('speedruns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $games = Game::all();
        $categories = Category::all();

        return view('speedruns.create', compact('games', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
            'category_id' => 'required|exists:categories,id',
            'run_time' => 'required|integer|min:1',
            'video_url' => 'nullable|url',
            'date' => 'nullable|date',
            'description' => 'nullable|string|max:1000',
        ]);


        $game = Game::findOrFail($validated['game_id']);
        $category = Category::findOrFail($validated['category_id']);

        $validated['game_name'] = $game->name;
        $validated['category'] = $category->name;
        $validated['user_id'] = auth()->id();

        Speedrun::create($validated);

        return redirect()->route('profile.view')->with('success', 'Speedrun created successfully!');
    }




    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $user = $request->user()->load('speedruns');
        return view('profile', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Speedrun $speedrun)
    {
        $games = Game::all();
        $categories = Category::all();

        return view('speedruns.edit', compact('speedrun', 'games', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Speedrun $speedrun)
    {
        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
            'category_id' => 'required|exists:categories,id',
            'run_time' => 'required|integer|min:1',
            'video_url' => 'nullable|url',
            'date' => 'nullable|date',
            'description' => 'nullable|string|max:1000',
        ]);


        $speedrun->update($validated);

        return redirect()->route('profile.view')->with('success', 'Speedrun updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Speedrun $speedrun)
    {
        $speedrun->delete();

        return redirect()->route('profile.view')->with('success', 'Speedrun deleted ');
    }

    public function recent()
    {
        $speedruns = Speedrun::with(['user', 'game', 'category'])
            ->latest('created_at')
            ->take(10)
            ->get()
            ->map(function ($speedrun) {
                return [
                    'game_name' => $speedrun->game->name ?? 'Unknown Game',
                    'category_name' => $speedrun->category->name ?? 'Unknown Category',
                    'user_name' => $speedrun->user->name ?? 'Anonymous',
                    'user_photo' => $speedrun->user->profile_photo
                        ? asset('storage/' . $speedrun->user->profile_photo)
                        : asset('default-profile.png'),
                    'run_time' => gmdate('H:i:s', $speedrun->run_time),
                    'date' => $speedrun->date,
                    'verified_status' => $speedrun->verified_status,
                    'description' => $speedrun->description ?? 'No description',
                ];
            });

        return response()->json(['speedruns' => $speedruns]);
    }



}
