<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() {

        return view('home');
    }

    public function about() {
        return view('about');
    }

    public function notImplemented()
    {
        return view('not-implemented');
    }

    public function games()
    {
        return view('games');
    }

    public function login()
    {
        return view('login');
    }

    public function settings()
    {
        return view('settings');
    }
}
