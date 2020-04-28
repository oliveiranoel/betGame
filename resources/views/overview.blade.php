@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if( $tournamentWinner )
            <div class="card">
                <div class="card-header">{{__('Tournament Winner')}}</div>
                <div class="card-body">
                    <div>
                        {{ $tournamentWinner->name }}
                    </div>
                </div>
            </div>
            @endif

            <div class="card @if( $tournamentWinner ) mt-4 @endif">
                <div class="card-header">{{__('Overview')}}</div>
                <div class="card-body">
                    <div>
                        <p>
                            @if ( Auth::user() )
                                {{ __('Your points:')}} {{ Auth::user()->points }}
                            @endif
                        </p>
                    </div>

                    <table class="table">
                        <thead thead-dark>
                            <tr>
                                <th scope="col">{{ __('Place')}}</th>
                                <th scope="col">{{ __('Nickname')}}</th>
                                <th scope="col">{{ __('Points')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $players as $player )
                                @if( Auth::user() == $player )
                                    <tr class="table-primary">
                                @else
                                    <tr>
                                @endif
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $player->nickname }}</td>
                                        <td>{{ $player->points }}</td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">{{__('Current games')}}</div>
                <div class="card-body">
                    <div>
                        <table class="table table-hover">
                            <thead thead-dark>
                            </thead>
                            <tbody>
                                @foreach( $games as $game )
                                    @if( $loop->iteration <= 5 )
                                        <tr class="cursor-pointer" data-href="{{ route('bet.index') }}">
                                            <td>{{ date('d.m.Y', strtotime($game->date)) }}</td>
                                            <td>
                                                <div class="form-group row">
                                                    <label for="score1" class="col-md-4 col-form-label text-md-right">
                                                        {{ $teams[$game->team1_id]->name }}
                                                    </label>
                                                    <div class="col-md-2">
                                                        <input id="score1" type="number" class="form-control" name="score1" value="{{ \App\Bet::bet( $game->id ) ? \App\Bet::bet( $game->id )->score1 : 0 }}" autocomplete="score1" disabled>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="score2" class="col-md-4 col-form-label text-md-right">
                                                        {{ $teams[$game->team2_id]->name }}
                                                    </label>
                                                    <div class="col-md-2">
                                                        <input id="score2" type="number" class="form-control" name="score2" value="{{ \App\Bet::bet( $game->id ) ? \App\Bet::bet( $game->id )->score2 : 0 }}" autocomplete="score2" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        @break
                                    @endif
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
