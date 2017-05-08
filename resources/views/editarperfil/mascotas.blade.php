@extends('layouts.app')

@section('content')
    <script type="text/javascript">

        function toggler(divId) {
            $("#" + divId).toggle();
        }

    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Perfil</div>

                    <div class="panel-body">
                        <ul class="nav nav-tabs nav-top-border">
                            <li><a href="{{'cuenta'}}">Datos Personales</a></li>
                            <li><a href="{{'password'}}">Contraseña</a></li>
                            <li class="active"><a href="{{'mascotas'}}">Mascotas</a></li>
                            <li><a href="{{'premium'}}">Premium</a></li>
                        </ul>
                        @foreach($num as $mascota)
                            <a href="{{'editar/mascotas/',$mascota->id}}{{$mascota->id}}"><input class="btn" type="button" value="{{$mascota->nombre}}"></a>
                        @endforeach

                        @foreach($animales as $a)
                            <a href="{{'mascotas/add/',$a->id}}{{$a->id}}"><input class="btn" type="button" value="Añadir un nuevo {{$a->nombre}}"></a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


@endsection
