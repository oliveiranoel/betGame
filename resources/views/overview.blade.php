@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
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
                        <table class="table">
                            <thead thead-dark>
                            <tr>
                                <th scope="col">{{ __('Date')}}</th>
                                <th scope="col">{{ __('Game')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < 5; $i++)
                                    <tr>
                                        <td>{{ date('d.m.Y', strtotime($games[$i]->date)) }}</td>
                                        <td>
                                            {{ $teams[$games[$i]->team1_id]->name }}
                                            <input type="number" min=0 max=50 value="{{ $games[$i]->score1 }}" /> :
                                            <input type="number" min=0 max=50 value="{{ $games[$i]->score2 }}" />
                                            {{ $teams[$games[$i]->team2_id]->name }}
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
