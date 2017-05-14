@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($mensaje))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ $mensaje }}
        </div>
    @endif
        <h1 class="text-center">{{$publicacion->titulo}}</h1>
        <h2 class="text-center">{{$publicacion->cuerpo}}</h2>

        <input type="submit" value="Contactar">
</div>

@endsection
