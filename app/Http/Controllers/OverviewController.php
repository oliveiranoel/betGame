<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class OverviewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all()->sortByDesc('points');
        return view('overview')->with('players', $users);
    }
}
