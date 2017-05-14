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
            <h1>Perfil de <span class="text-capitalize">{{$usuario[0]->nombre}}</span></h1>
            <img src="../storage/{{ $usuario[0]->avatar }}" class="img-responsive"><br>
            <p>{{$usuario[0]->nombre}}</p>
            <p class="text-capitalize">{{$usuario[0]->login}}</p>
            <button class="form-control"><a href="#">Compartir perfil</a></button>


        </div>

        <div class="col-sm-9">
            @if(!empty($tuspublicaciones->first()))

                <h2>Sus Publicaciones</h2>


                @foreach($tuspublicaciones as $p)
                    <a href="{{'../publicacion/',$p->id}}{{$p->id}}">
                    <div class="col-md-6" style="display: table">
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

                        <div class="col-sm-9 col-md-3">
                            <a href="{{'../mascota/',$m->id}}{{$m->id}}">
                            <div class="thumbnail">
                                <img alt="{{$m->nombre}}" src="../storage/{{$m->avatar}}" class="img-responsive" data-holder-rendered="true">
                                <div class="caption">
                                    <h3>{{$m->nombre}}</h3>
                                    <p>{{$m->animal}}</p>
                                    <p>{{$m->raza}}</p>
                                    <p>{{$m->genero}}</p>
                                    <!--<p><a href="#" class="btn btn-primary" role="button">Button</a>></p>-->
                                </div>
                            </div>
                            </a>
                        </div>

                @endforeach
            @endif
        </div>
    </div>
</div>


@endsection
