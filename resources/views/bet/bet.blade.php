@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{__('Current games')}}</div>
                    <div class="card-body">
                        <div>
                            <table class="table">
                                <thead thead-dark>
                                </thead>
                                <tbody>
                                @foreach( $games as $game )
                                    <tr>
                                        <td>{{ date('d.m.Y', strtotime($game->date)) }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('bet.update', \App\Bet::bet( $game->id ) ? \App\Bet::bet( $game->id )->id : -1) }}">
                                                @method('put')
                                                @csrf

                                                <input id="gameid" type="number" class="invisible" name="gameid" value="{{ $game->id }}">
                                                <div class="form-group row">
                                                    <label for="score1" class="col-md-4 col-form-label text-md-right">
                                                        {{ $teams[$game->team1_id]->name }}
                                                    </label>
                                                    <div class="col-md-2">
                                                        <input id="score1" type="number" class="form-control" name="score1" value="{{ \App\Bet::bet( $game->id ) ? \App\Bet::bet( $game->id )->score1 : 0 }}" autocomplete="score1">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="score2" class="col-md-4 col-form-label text-md-right">
                                                        {{ $teams[$game->team2_id]->name }}
                                                    </label>
                                                    <div class="col-md-2">
                                                        <input id="score2" type="number" class="form-control" name="score2" value="{{ \App\Bet::bet( $game->id ) ? \App\Bet::bet( $game->id )->score2 : 0 }}" autocomplete="score2">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md offset-md-4">
                                                        <button type="submit" class="col-md-2 btn btn-primary">
                                                            {{ __('Save') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
