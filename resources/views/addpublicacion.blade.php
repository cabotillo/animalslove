@extends('layouts.app')

@section('content')

<div class="container">
    @if(isset($_GET['u']))
        @if($_GET['u'] == 1)
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Se ha añadido la publicación correctamente
            </div>
        @elseif($_GET['u'] == 0)
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Se ha producido un error. Vuelve a intentarlo más tarde
            </div>
        @endif
    @endif
    <div class="row col-md-10">

        <div class="panel panel-default">
            <div class="panel-heading">Añadir Publicación</div>
            <div class="panel-body">
                <form action="{{route('nuevapublicacion')}}" method="post">
                    {{ csrf_field() }}
                    <div class="col-md-6 form-group{{ $errors->has('mascota') ? ' has-error' : '' }}">
                        <label class="control-label">Mascota</label>
                        <select class="form-control" name="mascota">

                            @foreach($mascotas as $m)
                                <option @if( old('provincia')) selected="selected" @endif value="{{$m->id}}">{{$m->nombre}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('mascota'))
                            <span class="help-block">
                                <strong>{{ $errors->first('mascota') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-6 form-group{{ $errors->has('publicacion') ? ' has-error' : '' }}">
                        <label class="control-label">Tipo de publicacion</label>
                        <select class="form-control" name="publicacion">
                            @foreach($tipop as $t)
                                <option @if( old('publicacion')) selected="selected" @endif value="{{$t->id}}">{{$t->tipo}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('publicacion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('publicacion') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="col-md-12 form-group {{ $errors->has('cuerpo') ? ' has-error' : '' }}">
                        <label class="control-label">Mas información</label>
                        <textarea class="form-control" name="cuerpo">{{old('cuerpo')}}</textarea>
                        @if ($errors->has('cuerpo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('cuerpo') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-primary" value="Insertar nueva publicación">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
