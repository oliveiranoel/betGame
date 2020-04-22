@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Game</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">{{ __('Id') }}</th>
                                <th scope="col">{{ __('Date') }}</th>
                                <th scope="col">{{ __('Team 1') }}</th>
                                <th scope="col">{{ __('Score Team 1') }}</th>
                                <th scope="col">{{ __('Team 2') }}</th>
                                <th scope="col">{{ __('Score Team 2') }}</th>
                                <th></th>
                                <th scope="col" class="text-right">
                                    <form method="GET" action="{{ route('game.create') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-default p-0"><span
                                                class="fas fa-plus-circle" style="font-size: 20px"></span>
                                        </button>
                                    </form>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($games as $game)
                                <tr>
                                    <td>{{ $game->id }}</td>
                                    <td>{{ $game->date }}</td>
                                    <td>{{ \App\Team::findOrFail($game->team1_id)->name }}</td>
                                    <td>{{ $game->score1 }}</td>
                                    <td>{{ \App\Team::findOrFail($game->team2_id)->name }}</td>
                                    <td>{{ $game->score2 }}</td>
                                    <td class="text-right">
                                        <form method="GET" action="{{ route('game.edit', [$game->id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-default p-0"><span
                                                    class="fas fa-pencil-alt"
                                                    style="font-size: 20px"></span></button>
                                        </form>

                                    </td>
                                    <td class="text-right">
                                        <form method="POST" action="{{ route('game.destroy', [$game->id]) }}">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-default p-0"><span
                                                    class="fas fa-trash-alt"
                                                    style="font-size: 20px"></span></button>
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
@endsection
