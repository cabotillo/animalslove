@extends('layouts.app')

@section('content')
    <script type="text/javascript">

        function toggler(divId) {
            $("#" + divId).toggle();
        }

    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Perfil</div>

                    <div class="panel-body">
                        <ul class="nav nav-tabs nav-top-border">
                            <li class="active"><a href="{{'cuenta'}}">Datos Personales</a></li>
                            <li><a href="{{'home'}}">Contraseña</a></li>
                            <li><a href="{{'mascotas'}}">Mascotas</a></li>
                            <li><a href="{{'premium'}}">Premium</a></li>
                        </ul>

                    <form role="form" action="{{route('editarperfil.cuenta')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label class="control-label">Nombre</label>
                            <input name="nombre" type="text" placeholder="Nombre" class="form-control" value="{{Auth::user()->nombre}}">
                            @if ($errors->has('nombre'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('apellidos') ? ' has-error' : '' }}">
                            <label class="control-label">Apellidos</label>
                            <input name="apellidos" type="text" placeholder="Apellidos" class="form-control" value="{{Auth::user()->apellidos}}">
                            @if ($errors->has('apellidos'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('apellidos') }}</strong>
                                        </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="control-label">Correo Electrónico</label>
                            <input name="email" type="text" placeholder="Correo electrónico" class="form-control" value="{{Auth::user()->email}}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('telefono') ? ' has-error' : '' }}">
                            <label class="control-label">Telefono</label>
                            <input name="telefono" type="number" placeholder="666666666" class="form-control" value="{{Auth::user()->telefono}}">
                            @if ($errors->has('telefono'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('telefono') }}</strong>
                                        </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Imagen de perfil</label><br>

                            <div class="thumbnail col-md-6">
                                <img src="../storage/{{ Auth::user()->avatar }}" width="50%" height="50%"></img>
                            </div>
                            <div class="col-md-6">
                                <input type="file" name="img">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <input type="submit" class="btn btn-primary" value="Guardar Cambios">
                        </div>
                    </form>
                    </div>
                </div>
                    <!-- /Datos Personales -->


            </div>
        </div>
    </div>


@endsection
