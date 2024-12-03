<?php

namespace App\Http\Controllers;

use App\Models\Speedrun;
use Illuminate\Http\Request;

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
        return view('speedruns.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'run_time' => 'required|integer|min:1',
            'video_url' => 'nullable|url',
            'date' => 'nullable|date',
            'description' => 'nullable|string|max:1000',
        ]);

        $validated['user_id'] = auth()->id();

        Speedrun::create($validated);

        return redirect()->route('profile.view')->with('success', 'Speedrun created ');
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
        return view('speedruns.edit', compact('speedrun'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Speedrun $speedrun)
    {
        $validated = $request->validate([
            'game_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'run_time' => 'required|integer|min:1',
            'video_url' => 'nullable|url',
            'date' => 'nullable|date',
            'description' => 'nullable|string|max:1000',
            'verified_status' => 'required|boolean',
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

}
