@extends('layouts.app')

@section('content')
<div class="container" xmlns:border="http://www.w3.org/1999/xhtml">
    @if(isset($mensaje))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ $mensaje }}
        </div>
    @endif
    <div class="row">

        <div class="col-sm-3">
            <h1>Perfil de <span class="text-capitalize">{{$usuario[0]->nombre}}</span></h1>
            <img src="../storage/{{ $usuario[0]->avatar }}" class="img-responsive"><br>
            <p>{{$usuario[0]->nombre}}</p>
            <p class="text-capitalize">{{$usuario[0]->login}}</p>
            <button class="form-control"><a href="#">Compartir perfil</a></button>


        </div>

        <div class="col-sm-9">
            @if(!$tuspublicaciones == '')

                <h2>Sus Publicaciones</h2>
                @foreach($tuspublicaciones as $p)
                    <p>{{$p->titulo}}</p>
                    <p>{{$p->cuerpo}}</p>

                @endforeach
            @endif

            @if(!$tusmascotas == '')

                <h2>Sus Mascotas</h2>
                @foreach($tusmascotas as $m)
                <div class="mascotas col-sm-3" id="{{$m->animal_id}}" style="border: 1px solid #98cbe8">
                    <p>{{($m)->nombre}}</p>
                        <img src="../storage/{{$m->avatar}}" class="img-responsive">
                        <p>{{($m)->animal_id}}</p>
                        <p>{{($m)->raza_id}}</p>
                        <p>{{($m)->genero}}</p>
                </div>
                @endforeach
            @endif

        </div>

    </div>
</div>

@endsection
