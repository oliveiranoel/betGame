@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Team</div>
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
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Tournament Winner') }}</th>
                                <th scope="col"></th>
                                <th scope="col" class="text-right">
                                    <form method="GET" action="{{ route('team.create') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-default p-0"><span class="fas fa-plus-circle" style="font-size: 20px"></span>
                                        </button>
                                    </form>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teams as $team)
                                <tr>
                                    <td>{{ $team->id }}</td>
                                    <td>{{ $team->name }}</td>
                                    <td>
                                        @if($team->tournamentWinner == 0)
                                            false
                                        @else
                                            true
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <form method="GET" action="{{ route('team.edit', [$team->id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-default p-0"><span class="fas fa-pencil-alt"
                                                                     style="font-size: 20px"></span></button>
                                        </form>

                                    </td>
                                    <td class="text-right">
                                        <form method="POST" action="{{ route('team.destroy', [$team->id]) }}">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-default p-0"><span class="fas fa-trash-alt"
                                                                     style="font-size: 20px" onclick="return confirm('Are you sure?')"></span></button>
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
