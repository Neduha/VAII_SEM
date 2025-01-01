<?php

namespace App\Http\Controllers;

use App\Models\Speedrun;
use Illuminate\Http\Request;

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

}

