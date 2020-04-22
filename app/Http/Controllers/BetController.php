<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Game;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BetController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $games = Game::all()->sortBy('date');
        $users = User::all()->sortByDesc('points');
        $teams = Team::all()->mapWithKeys(function($item) {
            return [$item['id'] => $item];
        });

        return view('bet.bet')->with([
            'players' => $users,
            'games' => $games,
            'teams' => $teams,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($id == -1) {
            $bet = Bet::create([
                'user_id' => Auth::user()->id,
                'game_id' => $request->input('gameid'),
                'score1' => $request->input('score1'),
                'score2' => $request->input('score2')
            ]);
            $bet->save();
        }
        else {
            $bet = Bet::find($id);
            $bet->score1 = $request->input('score1');
            $bet->score2 = $request->input('score2');
            $bet->save();
        }

        return redirect('/bet');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
