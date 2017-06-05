@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Session::has('message'))
            <p class="alert {{ \Illuminate\Support\Facades\Session::get('alert-class', 'alert-success') }}">{{ \Illuminate\Support\Facades\Session::get('message') }}</p>
        @endif
        <div class="row">
            <h1>Usuarios de la web</h1>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Login</td>
                    <td>Email</td>
                    <td>Telefono</td>
                    <td>Premium</td>
                    <td>Perfil</td>
                    <td>Editar</td>
                    <td>Reportes</td>
                    <td>Privilegios</td>
                    <td>Bloquear/Desbloquear</td>
                </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $u)
                        <!--Usuarios disponibles en verde-->
                        @if($u->tipo == 'Administrador')<tr class="success">
                            <td>{{$u->nombre}}</td>
                            <td>{{$u->login}}</td>
                            <td>{{$u->email}}</td>
                            <td>{{$u->telefono}}</td>
                            <td>{{$u->tipo}}</td>
                            <td><a href="{{'perfil/',$u->login}}{{$u->login}}" class="btn btn-success"><span>Ver Perfil</span></a></td>
                            <td></td><td></td><td><a href="{{'quitaradmin/',$u->id}}{{$u->id}}" class="btn @if($u->id == Auth::user()->id) invisible @endif btn-primary">Quitar Admin</a></td><td></td>

                        @elseif($u->disponible== 1)<tr class="info">
                            <td>{{$u->nombre}}</td>
                            <td>{{$u->login}}</td>
                            <td>{{$u->email}}</td>
                            <td>{{$u->telefono}}</td>
                            <td>{{$u->tipo}}</td>
                            <td><a href="{{'perfil/',$u->login}}{{$u->login}}" class="btn btn-success"><span>Ver Perfil</span></a></td>
                            <td><a href="{{'admin/editarcuenta/',$u->id}}{{$u->id}}" class="btn btn-warning">Editar</a></td>
                            <td><a href="{{'reporte/',$u->id}}{{$u->id}}" class="btn btn-info">Dar Toque</a></td>
                            <td><a href="{{'daradmin/',$u->id}}{{$u->id}}" class="btn btn-primary">Dar Admin</a></td>
                            <td><a href="{{'bloquear/',$u->id}}{{$u->id}}" class="btn btn-danger">X</a></td>
                        @elseif($u->disponible== 0)<tr class="danger">
                            <td>{{$u->nombre}}</td>
                            <td>{{$u->login}}</td>
                            <td>{{$u->email}}</td>
                            <td>{{$u->telefono}}</td>
                            <td>{{$u->tipo}}</td><td></td><td></td><td></td><td></td><td><a href="{{'desbloquear/',$u->id}}{{$u->id}}" class="btn btn-success">X</a></td>


                        @endif

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
