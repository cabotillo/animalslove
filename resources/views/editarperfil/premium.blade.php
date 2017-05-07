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
                            <li><a href="{{'cuenta'}}">Datos Personales</a></li>
                            <li><a href="{{'password'}}">Contraseña</a></li>
                            <li><a href="{{'mascotas'}}">Mascotas</a></li>
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
