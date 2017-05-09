@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(!Auth::guest())

                @if(isset($mensaje))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ $mensaje }}
                    </div>
                @endif
                <p>{{Auth::user()->mascotas}}</p>
            @endif
        </div>
    </div>
@endsection
