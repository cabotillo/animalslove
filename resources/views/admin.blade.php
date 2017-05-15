@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Usuarios de la web</h1>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Login</td>
                    <td>Email</td>
                    <td>Telefono</td>
                    <td>Premium</td>
                </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $u)
                        <!--Usuarios disponibles en verde-->
                        @if($u->tipo == 3)<tr class="success">@else<tr class="info">@endif

                            <td>{{$u->id}}</td>
                            <td>{{$u->nombre}}</td>
                            <td>{{$u->login}}</td>
                            <td>{{$u->email}}</td>
                            <td>{{$u->telefono}}</td>
                            <td>{{$u->tipo}}</td>
                            <td><a href="{{'perfil/',$u->login}}{{$u->login}}" class="btn btn-success"><span>Ver Perfil</span></a></td>
                            <td><input type="submit" name="editar" class="btn btn-warning" value="Editar"></td>
                            <td><a href="{{'reporte/',$u->id}}{{$u->id}}"><input type="submit" name="reporte" class="btn btn-info" value="Dar Toque"></a></td>
                            <td><input type="submit" name="admin" class="btn btn-primary" value="Dar Admin"></td>
                            <td><input type="submit" name="eliminar" class="btn btn-danger" value="X"></td>
                            </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
