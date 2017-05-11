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
                        <tr class="success">
                        <td>{{$u->id}}</td>
                        <td>{{$u->nombre}}</td>
                        <td>{{$u->login}}</td>
                        <td>{{$u->email}}</td>
                        <td>{{$u->telefono}}</td>
                        <td>{{$u->tipo}}</td>
                        <td><a href="{{'perfil/',$u->login}}{{$u->login}}" class="btn btn-info"><span>Ver Perfil</span></td>
                        <td><input type="submit" class="btn btn-warning" value="Editar"></td>
                        <td><input type="submit" class="btn btn-danger" value="Eliminar"></td>


                    @endforeach


                        </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
