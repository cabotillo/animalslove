@extends('layouts.app')

@section('content')
<div class="container">
        <h1 class="text-center">{{$publicacion->titulo}}</h1>
        <h2 class="text-center">{{$publicacion->cuerpo}}</h2>

        <a href="{{'../chat/',$usuario->login}}{{$usuario->login}}"><button class="form-control">Chat</button></a>
</div>

@endsection
