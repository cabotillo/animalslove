@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row col-md-8 col-md-offset-2">

        <div class="panel panel-default">
            <div class="panel-heading">Reportar</div>
            <div class="panel-body">
                <form role="form" method="post">
                    {{ csrf_field() }}
                    <h1>El usuario {{$u}} tiene {{$r}} avisos.</h1>
                    <h2>Es suficiente con reportar al usuario</h2>
                    <h3>Pero puede añadir la mascota o la publicación reportada</h3>
                    <div class="form-group">
                        <label class="control-label">Mascota</label>
                        <select class="form-control" name="mascota">
                            <option></option>
                            @foreach($mascotas as $m)
                                <option value="{{$m->id}}">{{$m->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Publicación</label>
                        <select class="form-control" name="publicacion">
                            <option></option>
                            @foreach($publicacion as $p)
                                <option value="{{$p->id}}">{{$p->titulo}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-primary" value="Dar toque al Usuario">
                    </div>
                    <input type="hidden" name="user_id" value="{{$u}}">
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
