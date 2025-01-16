<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Models\Category;

class GamesController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('games', compact('games'));
    }

    public function create()
    {
        return view('admin.games.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'release_date' => 'required|date',
            'developer' => 'required|string|max:255',
            'image' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('games', 'public');
        }

        Game::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Game created successfully!');
    }

    public function show(Game $game)
    {

        $speedruns = $game->speedruns()
            ->whereHas('category', function ($query) {
                $query->where('name', 'Any%');
            })
            ->with('user')
            ->get();

        $categories = Category::all();
        $speedrunCount = $game->speedruns->count();

        return view('game-show', compact('game', 'speedruns', 'categories', 'speedrunCount'));
    }

    public function filterSpeedruns(Game $game, Request $request)
    {
        $category = $request->query('category', 'any%');

        $speedruns = $game->speedruns()
            ->whereHas('category', function ($query) use ($category) {
                if ($category !== 'all') {
                    $query->where('name', $category);
                }
            })
            ->with('user')
            ->get()
            ->map(function ($speedrun) {
                return [
                    'user_name' => $speedrun->user->name,
                    'date' => $speedrun->date,
                    'run_time' => gmdate('H:i:s', $speedrun->run_time),
                    'verified' => $speedrun->verified_status,
                ];
            });

        return response()->json($speedruns);
    }



    public function search(Request $request)
    {

        $query = $request->query('query', '');

        if (empty($query)) {
            return response()->json(['games' => []]);
        }

        $games = Game::query()
            ->where('name', 'like', '%' . $query . '%')
            ->get()
            ->map(function ($game) {
                return [
                    'id' => $game->id,
                    'name' => $game->name,
                    'image' => $game->image,
                    'release_date' => \Carbon\Carbon::parse($game->release_date)->year,
                    'speedrun_count' => $game->speedruns->count(),
                ];
            });

        return response()->json(['games' => $games]);
    }








}
