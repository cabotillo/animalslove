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

        <h1>Perfil de <span class="text-capitalize">{{\Illuminate\Support\Facades\Auth::user()->login}}</span></h1>

        <div>
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
