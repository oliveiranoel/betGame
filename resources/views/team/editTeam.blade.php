@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Team</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('team.update', [$team->id]) }}">
                            @method('put')
                            @csrf
                            <div class="form-row align-items-center">
                                <div class="col-8 mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ $team->name }}">
                                </div>
                                <div class="col-auto mt-3 ml-3">
                                    <div class="form-check custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="tournamentWinner"
                                               name="tournamentWinner"
                                               value="true" {{ $team->tournamentWinner == 1 ? 'checked' : ''}}>
                                        <label class="custom-control-label" for="tournamentWinner">
                                            Tournament Winner
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('team.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
