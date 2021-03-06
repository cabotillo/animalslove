@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <!--Menu Principal -->
        <div class="col-sm-12">
            <div class="row">
                <h1 class="text-center">Buscador de usuarios por provincias</h1><br>
            </div>

            <form method="post" action="{{route('filtrousuarios')}}">
                {{ csrf_field() }}
                <div class="col-md-6">
                    <label class="control-label">Nombre de Usuario</label>
                    <input class="form-control" type="text" name="usuario" placeholder="Puede estar vacío" value="@if(isset($b)){{$b}}@else{{old('usuario')}}@endif">
                </div>
                <div class="col-md-6">
                    <label class="control-label">Provincia</label>
                    <select class="form-control" name="provincia">
                        <option></option>
                        @foreach($provincias as $p)

                                @if(isset($pro))

                                <option @if($pro == $p->id) selected="selected" @endif value="{{$p->id}}">{{$p->provincia}}</option>
                                 @else

                                <option value="{{$p->id}}">{{$p->provincia}}</option>

                                @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 bntEnviar">
                    <input class="btn btn-primary" type="submit" value="Filtrar">
                </div>

            </form>
            @if(empty($usuarios[0]) && empty($mascotas[0]))
                @if(isset($b))
                    <h2 class="text-center">Usuarios no encontrados</h2>
                    @endif
            @endif
            @if(!empty($usuarios[0]))

                <h2 class="text-center">Hay {{count($usuarios)}} usuario(s):</h2>
                <div class="col-md-12">
                @foreach($usuarios as $u)
                    <a href="{{'perfil/',$u->login}}{{$u->login}}">
                        <div class="col-sm-4 col-md-3">
                            <p>{{$u->nombre}}</p>
                            <img alt="{{$u->nombre}}" src="storage/{{$u->avatar}}" class="img-responsive imgmascotas">
                        </div>
                    </a>
                @endforeach
                </div>
            @endif

            <div class="clearfix"></div>
            @if(!empty($mascotas[0]))

                <h2 class="text-center">Hay {{count($mascotas)}} mascota(s): </h2>
                <div class="col-md-12">
                    @foreach($mascotas as $m)

                        <a href="{{'mascota/',$m->id}}{{$m->id}}"><div class="mascota @if($m->genero == 'Macho') macho @else hembra @endif col-sm-4 col-md-3">
                                <p>{{$m->nombre}}</p>
                                <img alt="{{$m->nombre}}" src="storage/{{$m->avatar}}" class="img-responsive imgmascotas">

                            </div></a>
                    @endforeach
                </div>

            @endif
        </div>
    </div>
</div>
@endsection

