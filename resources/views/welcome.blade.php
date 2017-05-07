@extends('layouts.app')

@section('content')
    <div class="container">
        @if(isset($mensaje))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ $mensaje }}
            </div>
        @endif
        <div class="row">
            @if(!Auth::guest())
                <p>{{Auth::user()->mascotas}}</p>
            @endif
        </div>
    </div>
@endsection
