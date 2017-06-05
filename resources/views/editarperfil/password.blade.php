@extends('layouts.app')

@section('content')
    <div class="container">
        @if(isset($_GET['u']))
            @if($_GET['u'] == 1)
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Contraseña modificada correctamente
                </div>
            @elseif($_GET['u'] == 0)
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Se ha producido un error. Vuelve a intentarlo más tarde
                </div>
            @endif
        @endif
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Perfil</div>

                    <div class="panel-body">
                        <ul class="nav nav-tabs nav-top-border">
                            <li><a href="{{'cuenta'}}">Datos Personales</a></li>
                            <li class="active"><a href="{{'password'}}">Contraseña</a></li>
                            <li><a href="{{'mascotas'}}">Añadir Mascota</a></li>
                            <li><a href="{{'premium'}}">Premium</a></li>
                        </ul>
                        <form action="{{route('editarperfil.password')}}" method="post">
                        {{ csrf_field() }}
                            <div class="col-sm-6 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Contraseña</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary" value="Guardar Cambios">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
