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
            <img src="../storage/usuarios/{{ $usuario[0]->avatar }}" class="img-responsive"><br>
            <p>{{$usuario[0]->nombre}}</p>
            <p class="text-capitalize">{{$usuario[0]->login}}</p>
            <button class="form-control"><a href="#">Compartir perfil</a></button>


        </div>

        <div class="col-sm-9">
            @if(!$tuspublicaciones == '')

                <h2>Sus Publicaciones</h2>


                @foreach($tuspublicaciones as $p)

                    <div class="media col-sm-6 col-md-6">
                        <div class="media-left"> <a href="#">
                                <img alt="animal" class="media-object img-responsive"  src="../storage/mascotas/avatar.jpg" data-holder-rendered="true" > </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{$p->titulo}}</h4>
                            {{$p->cuerpo}}
                        </div>

                    </div>

                @endforeach
            @endif

            <div class="clearfix"></div>

            @if(!$tusmascotas == '')

                <h2>Sus Mascotas</h2>
                @foreach($tusmascotas as $m)

                        <div class="col-sm-9 col-md-3">
                            <div class="thumbnail" id="{{$m->animal_id}}">
                                <img alt="{{$m->nombre}}" src="../storage/{{$m->avatar}}" class="img-responsive" data-holder-rendered="true">
                                <div class="caption">
                                    <h3>{{$m->nombre}}</h3>
                                    <p>{{$m->animal}}</p>
                                    <p>{{$m->raza}}</p>
                                    <p>{{$m->genero}}</p>
                                    <!--<p><a href="#" class="btn btn-primary" role="button">Button</a>></p>-->
                                </div>
                            </div>
                        </div>

                @endforeach
            @endif
        </div>
    </div>
</div>


@endsection
