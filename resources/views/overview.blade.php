@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Overview</div>
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
        </div>
    </div>
</div>
@endsection
