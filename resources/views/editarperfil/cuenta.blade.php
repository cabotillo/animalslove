@extends('layouts.app')

@section('content')
    <div class="container">
        @if(isset($_GET['u']))
            @if($_GET['u'] == 1)
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Perfil actualizado correctamente con avatar
                </div>
            @elseif($_GET['u'] == 0)
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Se ha producido un error. Vuelve a intentarlo más tarde
                </div>
            @endif
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading">Editar Perfil</div>

                    <div class="panel-body">
                        <ul class="nav nav-tabs nav-top-border">
                            <li class="active"><a href="{{'cuenta'}}">Datos Personales</a></li>
                            <li><a href="{{'password'}}">Contraseña</a></li>
                            <li><a href="{{'mascotas'}}">Añadir Mascota</a></li>
                            <li><a href="{{'premium'}}">Premium</a></li>
                        </ul>

                    <form action="{{route('editarperfil.cuenta')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-sm-12 col-md-6 form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label class="control-label">Nombre</label>
                            <input name="nombre" type="text" placeholder="Nombre" class="form-control" value="{{Auth::user()->nombre}}">
                            @if ($errors->has('nombre'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                            @endif
                        </div>
                        <div class="col-sm-12 col-md-6 form-group {{ $errors->has('apellidos') ? ' has-error' : '' }}">
                            <label class="control-label">Apellidos</label>
                            <input name="apellidos" type="text" placeholder="Apellidos" class="form-control" value="{{Auth::user()->apellidos}}">
                            @if ($errors->has('apellidos'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('apellidos') }}</strong>
                                        </span>
                            @endif
                        </div>
                        <div class="col-sm-12 form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="control-label">Correo Electrónico</label>
                            <input disabled name="email" type="text" placeholder="Correo electrónico" class="form-control" value="{{Auth::user()->email}}">

                        </div>
                        <div class="col-sm-12 col-md-6 form-group {{ $errors->has('telefono') ? ' has-error' : '' }}">
                            <label class="control-label">Telefono</label>
                            <input name="telefono" type="number" placeholder="666666666" class="form-control" value="{{Auth::user()->telefono}}">
                            @if ($errors->has('telefono'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('telefono') }}</strong>
                                        </span>
                            @endif
                        </div>

                        <div class="col-sm-12 col-md-6 form-group{{ $errors->has('provincia') ? ' has-error' : '' }}">
                            <label class="control-label">Provincia</label>
                                <select class="form-control" name="provincia">

                                    @foreach($provincias as $p)
                                        <option @if( old('provincia') == $p->id || Auth::user()->provincia_id == $p->id) selected="selected" @endif value="{{$p->id}}">{{$p->provincia}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('provincia'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('provincia') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="col-sm-12 form-group">
                            <label class="control-label">Imagen de perfil</label><br>

                            <div class="thumbnail col-md-6">
                                <img src="../storage/{{ Auth::user()->avatar }}" alt="avatar" id="avatar" class="img-responsive imgcuenta">
                            </div>
                            <div class="col-md-6">
                                <input type="file" name="avatar" id="file">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <input type="submit" class="btn btn-primary" value="Guardar Cambios">
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#file").change(function(){
            readURL(this);
        });

    </script>
@endsection
