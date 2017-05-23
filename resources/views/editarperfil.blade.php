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
                <h1>Perfil de {{$nombre[0]}}</h1>
                    <form role="form" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label class="control-label">Nombre</label>
                            <input name="nombre" type="text" placeholder="Nombre" class="form-control" value="{{$nombre[0]}}">
                            @if ($errors->has('nombre'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('apellidos') ? ' has-error' : '' }}">
                            <label class="control-label">Apellidos</label>
                            <input name="apellidos" type="text" placeholder="Apellidos" class="form-control" value="{{$apellidos[0]}}">
                            @if ($errors->has('apellidos'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('apellidos') }}</strong>
                                        </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="control-label">Correo Electrónico</label>
                            <input name="email" type="text" placeholder="Correo electrónico" class="form-control" value="{{$email[0]}}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('telefono') ? ' has-error' : '' }}">
                            <label class="control-label">Telefono</label>
                            <input name="telefono" type="number" placeholder="666666666" class="form-control" value="{{$telefono[0]}}">
                            @if ($errors->has('telefono'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('telefono') }}</strong>
                                        </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Imagen de perfil</label><br>

                            <div class="thumbnail col-md-6">
                                <img src="../../storage/{{ $avatar[0] }}" width="50%" height="50%" alt="avatar"></img>
                            </div>
                            <div class="col-md-6">
                                <input type="file" name="avatar">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="submit" class="btn btn-primary" value="Guardar Cambios">
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
