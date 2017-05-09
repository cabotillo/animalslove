@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <form role="form" action="{{route('nuevapublicacion')}}" method="post">

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

            <div class="form-group{{ $errors->has('publicacion') ? ' has-error' : '' }}">
                <label class="control-label">Tipo de publicacion</label>
                <select class="form-control" name="publicacion">
                    <option value="Criar">Criar</option>
                    <option value="Pasear">Pasear</option>
                    <option value="Guardar">Guardar durante un periodo de tiempo</option>
                    <option value="Regalo">Regalar</option>
                </select>
                @if ($errors->has('publicacion'))
                    <span class="help-block">
                        <strong>{{ $errors->first('publicacion') }}</strong>
                    </span>
                @endif
            </div>


            <div class="form-group {{ $errors->has('cuerpo') ? ' has-error' : '' }}">
                <label class="control-label">Mas información</label>
                <textarea class="form-control" name="cuerpo"></textarea>
                @if ($errors->has('cuerpo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('cuerpo') }}</strong>
                    </span>
                @endif
            </div>
            </form>
    </div>
</div>


@endsection
