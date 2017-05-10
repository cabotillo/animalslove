@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row col-md-8 col-md-offset-2">

        <div class="panel panel-default">
            <div class="panel-heading">Añadir Publicación</div>
            <div class="panel-body">
                <form role="form" action="{{route('nuevapublicacion')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('mascota') ? ' has-error' : '' }}">
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

                    <div class=" form-group{{ $errors->has('publicacion') ? ' has-error' : '' }}">
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


                    <div class="form-group {{ $errors->has('cuerpo') ? ' has-error' : '' }}">
                        <label class="control-label">Mas información</label>
                        <textarea class="form-control" name="cuerpo" value="{{old('cuerpo')}}"></textarea>
                        @if ($errors->has('cuerpo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('cuerpo') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-primary" value="Insertar la nueva noticia">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
