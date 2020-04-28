@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{__('Home')}}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ( Auth::user() )
                            You are currently logged in as
                            <span class="font-weight-bold font-italic">{{ Auth::user()->nickname }}</span>.
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Overview</h5>
                        <p class="card-text">User & Admin</p>
                        <a href="{{ route('overview') }}" class="btn btn-primary">Go to Overview</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Bet</h5>
                        <p class="card-text">User & Admin</p>
                        <a href="{{ route('bet.index') }}" class="btn btn-primary">Go to Bet</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Team</h5>
                        <p class="card-text">Admin only</p>
                        <a href="{{ route('team.index') }}" class="btn btn-primary {{ Auth::user()->admin ? '' : 'disabled'}}">Go to Team</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Game</h5>
                        <p class="card-text">Admin only</p>
                        <a href="{{ route('game.index') }}" class="btn btn-primary {{ Auth::user()->admin ? '' : 'disabled'}}">Go to Game</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
