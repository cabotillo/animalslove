@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Perfil</div>

                    <div class="panel-body">
                        <ul class="nav nav-tabs nav-top-border">
                            <li><a href="{{'../../cuenta'}}">Datos Personales</a></li>
                            <li><a href="{{'../../password'}}">Contraseña</a></li>
                            <li class="active"><a href="{{'../../mascotas'}}">Mascotas</a></li>
                            <li><a href="{{'../../premium'}}">Premium</a></li>
                        </ul>
                        <form action="" method="post">
                            {{ csrf_field() }}
                            <div class=" row panel-body">

                                <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                                    <label class="control-label">Nombre</label>
                                    <input type="text" class="form-control" value="{{old('nombre')}}" name="nombre">
                                    @if ($errors->has('nombre'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Animal</label>
                                    <input type="text" class="form-control" value="{{$animal[0]->nombre}}"disabled>

                                </div>
                                <div class="form-group">
                                    <label class="control-label">Raza</label>
                                    <select class="form-control" name="raza">

                                        @foreach($razas as $r)
                                            <option @if( old('raza') == $r->id) selected="selected" @endif value="{{$r->id}}">{{$r->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group {{ $errors->has('genero') ? ' has-error' : '' }}">
                                    <label class="control-label">Genero</label>
                                    <input type="text" class="form-control" value="{{old('genero')}}" name="genero" placeholder="Macho o hembra">
                                    @if ($errors->has('genero'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('genero') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Tamaño</label>
                                    <select class="form-control" name="tamanyo">
                                        <option selected = "selected" value="Pequeño">Pequeño</option>
                                        <option  value="Mediano">Mediano</option>
                                        <option  value="Grande">Grande</option>
                                        <option  value="Gigante">Gigante</option>

                                    </select>


                                </div>
                                <div class="form-group {{ $errors->has('edad') ? ' has-error' : '' }}">
                                    <label class="control-label">Edad</label>
                                    <input type="number" class="form-control" value="{{old('edad')}}" name="edad">
                                    @if ($errors->has('edad'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('edad') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <input type="submit" class="btn btn-primary" value="Guardar Cambios">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
