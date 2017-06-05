@extends('layouts.app')

@section('content')
    <div class="container">
        @if(isset($_GET['u']))
            @if($_GET['u'] == 1)
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Ya no eres Premium
                </div>
            @elseif($_GET['u'] == 2)
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Te has convertido en Premium
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
                            <li><a href="{{'password'}}">Contraseña</a></li>
                            <li><a href="{{'mascotas'}}">Añadir Mascota</a></li>
                            <li class="active"><a href="{{'premium'}}">Premium</a></li>
                        </ul>
                        <form action="{{route('editarperfil.premium')}}" method="post">
                        {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('premium') ? ' has-error' : '' }}">
                                <label for="premium">Premium</label>

                                @if (Auth::user()->tipo == '2')
                                    <input name="premium" type="checkbox" class="form-control" checked="">
                                @else
                                    <input name="premium" type="checkbox" class="form-control">
                                @endif

                                @if ($errors->has('premium'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('premium') }}</strong>
                                        </span>
                                @endif
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
