@extends('layouts.app')

@section('content')
<div class="container">
        <h1 class="text-center">{{$publicacion->titulo}}</h1>
        <h2 class="text-center">{{$publicacion->cuerpo}}</h2>

        <a href="{{'../perfil/',$usuario->login}}{{$usuario->login}}" class="btn btn-info form-control">Ver el perfil del usuario</a>
</div>

@endsection
