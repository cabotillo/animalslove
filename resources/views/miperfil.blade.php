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
            <img src="../../storage/app/public/usuarios/{{ $usuario[0]->avatar }}" class="img-responsive"><br>
            <p>{{$usuario[0]->nombre}}</p>
            <p class="text-capitalize">{{$usuario[0]->login}}</p>
            <button class="form-control"><a href="#">Compartir perfil</a></button>


        </div>

        <div class="col-sm-9">
            @if(!$tuspublicaciones == '')

                <h2>Sus Publicaciones</h2>


                @foreach($tuspublicaciones as $p)

                    <div class="media col-sm-6 col-md-4">
                        <div class="media-left"> <a href="#">
                                <img alt="" class="media-object"  src="../storage/mascotas/avatar.jpg" data-holder-rendered="true" style="width: 64px; height: 64px;"> </a>
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

                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail" id="{{$m->animal_id}}">
                                <img alt="" src="../storage/{{$m->avatar}}" data-holder-rendered="true" style="height: 200px; width: 100%;">
                                <div class="caption">
                                    <h3>{{$m->nombre}}</h3>
                                    <p>{{$m->animal_id}} -- {{$m->raza_id}} -- {{$m->genero}}</p>
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
