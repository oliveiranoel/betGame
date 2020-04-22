<?php

namespace App\Http\Controllers;

use App\Rules\tournamentWinnerRule;
use App\Team;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use function GuzzleHttp\Promise\queue;

class TeamController extends Controller
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
        return view('team.team')->with('teams', Team::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('team.newTeam');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        Team::create(
            [
                'name' => $request->input('name')
            ]
        );

        return redirect('/team');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function edit($id)
    {
        return view('team.editTeam')->with('team', Team::findOrFail($id));
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
        $team = Team::findOrFail($id);

        $team->name = $request->input('name');

        $request->validate([
            'tournamentWinner' => [new tournamentWinnerRule]
        ]);

        $team->tournamentWinner = $request->boolean('tournamentWinner');
        $team->save();

        return redirect('/team');
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
        Team::findOrFail($id)->delete();
        return redirect('/team');
    }
}
