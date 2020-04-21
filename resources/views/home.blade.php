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
</div>
@endsection
