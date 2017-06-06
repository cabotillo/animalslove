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

        <div class="col-sm-3">
            <h1 class="text-capitalize">{{$usuario[0]->login}}</h1>
            <img src="../storage/{{ $usuario[0]->avatar }}" class="img-responsive" alt="avatar"><br>
            <span>Nombre: {{$usuario[0]->nombre}}&nbsp;{{$usuario[0]->apellidos}}</span><br><br>
            @if(!Auth::guest())<div class="col-md-6">
                <a href="{{'../chat/',$usuario[0]->login}}{{$usuario[0]->login}}" class="btn btn-info" id="btnMensaje">Mensaje</a>
            </div>
            @endif
            <div class="col-md-6">
                <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fwww.animalslove.ml/perfil/{{$usuario[0]->login}}&layout=button&size=small&mobile_iframe=true&width=81&height=20&appId" width="81" height="20" class="facebook"></iframe>
            </div>
        </div>

        <div class="col-sm-9">
            @if(!empty($tuspublicaciones->first()))

                <h2>Sus Publicaciones</h2>


                @foreach($tuspublicaciones as $p)
                    <a href="{{'../publicacion/',$p->id}}{{$p->id}}">
                    <div class="col-md-6">
                        <h4 class="media-heading">{{$p->titulo}}</h4>
                        {{$p->cuerpo}}
                    </div>
                    </a>

                @endforeach
            @endif

            <div class="clearfix"></div>

                @if(!empty($tusmascotas->first()))

                <h2>Sus Mascotas</h2>
                    @foreach($tusmascotas as $m)

                        <a href="{{'../mascota/',$m->id}}{{$m->id}}"><div class="mascota @if($m->genero == 'Macho') macho @else hembra @endif col-sm-4 col-md-3">
                                <p>{{$m->nombre}}</p>
                                <img alt="{{$m->nombre}}" src="../storage/{{$m->avatar}}" class="img-responsive imgmascotas">

                            </div></a>
                    @endforeach
            @endif
        </div>
    </div>
</div>


@endsection
