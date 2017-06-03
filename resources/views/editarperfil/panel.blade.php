@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Administra tu perfil</h1>
        @if(Session::has('message'))
            <p class="alert {{ \Illuminate\Support\Facades\Session::get('alert-class', 'alert-success') }}">{{ \Illuminate\Support\Facades\Session::get('message') }}</p>
        @endif
            @if(Session::has('error'))
                <p class="alert {{ \Illuminate\Support\Facades\Session::get('alert-class', 'alert-danger') }}">{{ \Illuminate\Support\Facades\Session::get('error') }}</p>
            @endif
        <div class="row col-md-12">
            <div class="col-md-6">
                <h2>Tus mascotas</h2>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>Ver</td>
                        <td>Editar</td>
                        <td>Ocultar/Mostrar</td>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($mascotas as $m)
                            @if($m->disponible == 1)<tr class="success">@else<tr class="danger">@endif
                                <td>{{$m->nombre}}</td>
                                <td><a href="{{'mascota/',$m->id}}{{$m->id}}" class="btn btn-info"><span>Ver Mascota</span></a></td>
                                <td><a href="{{'editar/mascota/',$m->id}}{{$m->id}}"><input type="submit" name="editar" class="btn btn-warning" value="Editar"></a></td>
                                @if($m->disponible == 1)
                                    <td><a href="{{'eliminarMascota/',$m->id}}{{$m->id}}"><input type="submit" name="eliminar" class="btn btn-danger" value="X"></a></td>
                                @else
                                    <td><a href="{{'eliminarMascota/',$m->id}}{{$m->id}}"><input type="submit" name="eliminar" class="btn btn-success" value="X"></a></td>
                                @endif

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h2>Tus publicaciones</h2>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>Ver</td>
                        <td>Eliminar</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($publicaciones as $p)
                        @if($p->disponible == 1)<tr class="success">@else<tr class="danger">@endif
                        <td>{{$p->titulo}}</td>
                        <td><a href="{{'publicacion/',$p->id}}{{$p->id}}" class="btn btn-info"><span>Ver Publicacion</span></a></td>
                            @if($p->disponible == 1)
                                <td><a href="{{'eliminarPublicacion/',$p->id}}{{$p->id}}"><input type="submit" name="eliminar" class="btn btn-danger" value="X"></a></td>
                            @else
                                <td><a href="{{'eliminarPublicacion/',$p->id}}{{$p->id}}"><input type="submit" name="eliminar" class="btn btn-success" value="X"></a></td>
                            @endif

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
