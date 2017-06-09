@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <!--Menu Principal -->
        <div class="col-sm-12">
            <div class="row">
                <h1 class="text-center">{{$tipo}}</h1>

                @if(empty($mascotas))

                        <h2>{{$mensaje}}</h2>

                @else
            </div>
            </div>

                <div class="row">
                    <h2>{{$mensaje}}</h2>
                    @foreach($mascotas as $m)

                        <a href="{{'mascota/',$m->id}}{{$m->id}}"><div class="mascota @if($m->genero == 'Macho') macho @else hembra @endif col-sm-4">
                                <p>{{$m->nombre}}</p>
                                <img alt="{{$m->nombre}}" src="storage/{{$m->avatar}}" class="img-responsive imgmascotas">

                            </div></a>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
@endsection

