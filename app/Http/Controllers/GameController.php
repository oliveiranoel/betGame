<?php

namespace App\Http\Controllers;

use App\Game;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class GameController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('game.game')->with('games', Game::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('game.newGame');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        Game::create(
            [
                'date' => $request->input('date'),
                'team1_id' => $request->input('team1'),
                'team2_id' => $request->input('team2')
            ]
        );

        return redirect('/game');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function edit($id)
    {
        return view('game.editGame')->with('game', Game::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);

        $game->date = $request->input('date');
        $game->score1 = $request->input('score1');
        $game->score2 = $request->input('score2');
        $game->save();

        $users = User::all();
        $goalDifference = $game->score1 - $game->score2;
        foreach ($users as $user) {
            $bet = $user->bets->where('game_id', $game->id);

            if (count($bet) > 0) {
                $bet = $bet[0];
                if ($bet->score1 == $game->score1 && $bet->score2 == $game->score2) {
                    $user->points = $user->points + 3;
                } else if ($bet->score1 - $bet->score2 == $goalDifference) {
                    $user->points = $user->points + 2;
                } else if ($this->getWinner($game->score1, $game->score2) == $this->getWinner($bet->score1, $bet->score2)) {
                    $user->points = $user->points + 1;
                }
                $user->save();
            } else {
                error_log("Found multiple bets on same game.");
            }
        }

        return redirect('/game');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy($id)
    {
        Game::findOrFail($id)->delete();
        return redirect('/game');
    }

    private function getWinner($score1, $score2)
    {
        if ($score1 > $score2) {
            return 1;
        } else if ($score1 < $score2) {
            return 2;
        } else {
            return 0;
        }
    }
}
