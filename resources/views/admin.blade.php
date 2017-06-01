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
                    <td>Eliminar</td>
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
                            <td></td><td></td><td></td><td></td>

                        @elseif($u->disponible== 1)<tr class="info">
                            <td>{{$u->nombre}}</td>
                            <td>{{$u->login}}</td>
                            <td>{{$u->email}}</td>
                            <td>{{$u->telefono}}</td>
                            <td>{{$u->tipo}}</td>
                            <td><a href="{{'perfil/',$u->login}}{{$u->login}}" class="btn btn-success"><span>Ver Perfil</span></a></td>
                            <td><a href="{{'admin/editarcuenta/',$u->id}}{{$u->id}}"><input type="submit" name="editar" class="btn btn-warning" value="Editar"></td>
                            <td><a href="{{'reporte/',$u->id}}{{$u->id}}"><input type="submit" name="reporte" class="btn btn-info" value="Dar Toque"></a></td>
                            <td><a href="{{'daradmin/',$u->id}}{{$u->id}}"><input type="submit" class="btn btn-primary" value="Dar Admin"@if($u->tipo == 3) id="invisible" @endif></a></td>
                            <td><a href="{{'bloquear/',$u->id}}{{$u->id}}"><input type="submit" name="eliminar" class="btn btn-danger" value="X"></td>
                        @elseif($u->disponible== 0)<tr class="danger">
                            <td>{{$u->nombre}}</td>
                            <td>{{$u->login}}</td>
                            <td>{{$u->email}}</td>
                            <td>{{$u->telefono}}</td>
                            <td>{{$u->tipo}}</td><td></td><td></td><td></td><td></td><td></td>


                        @endif

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
