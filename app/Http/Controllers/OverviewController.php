<?php

namespace App\Http\Controllers;

use App\Game;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use function Illuminate\Support\Facades\Log;

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
        $games = Game::all()->sortBy('date');
        $users = User::all()->sortByDesc('points');
        $teams = Team::all()->mapWithKeys(function($item) {
            return [$item['id'] => $item];
        });

        return view('overview')->with([
            'players' => $users,
            'games' => $games,
            'teams' => $teams
        ]);
    }
}
