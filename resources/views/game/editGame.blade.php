@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Game</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('game.update', [$game->id]) }}">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="date" value="{{ $game->date }}">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-9 mb-3">
                                    <label for="team1">Team 1</label>
                                    <input class="form-control" type="text" id="team1" readonly value="{{ \App\Team::findOrFail($game->team1_id)->name }}">
                                </div>
                                <div class="form-group col-md-3 mb-3">
                                    <label for="score1">Score Team 1</label>
                                    <input type="number" class="form-control" id="score1" name="score1"
                                    value="{{ $game->score1 }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-9 mb-3">
                                    <label for="team2">Team 2</label>
                                    <input class="form-control" type="text" id="team2" readonly value="{{ \App\Team::findOrFail($game->team2_id)->name }}">
                                </div>
                                <div class="form-group col-md-3 mb-3">
                                    <label for="score2">Score Team 2</label>
                                    <input type="number" class="form-control" id="score2" name="score2"
                                           value="{{ $game->score2 }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('game.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
