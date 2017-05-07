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
                        <ul class="nav nav-tabs nav-top-border">
                            <li class="active"><a href="#datosp" data-toggle="tab">Datos Personales</a></li>
                            <li><a href="#password" data-toggle="tab">Contraseña</a></li>
                            <li><a href="#mascotas" data-toggle="tab">Mascotas</a></li>
                            <li><a href="#premium" data-toggle="tab">Premium</a></li>
                        </ul>

                        <div class="tab-content">

                            <!-- Datos Personales-->
                            <div class="tab-pane fade in active" id="datosp">
                                <form role="form" action="{{route('editarperfil')}}" method="post">
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
                                            <img src="storage/{{ Auth::user()->avatar }}" width="50%" height="50%"></img>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="file" name="img">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">
                                            Guardar Cambios
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- /Datos Personales -->

                            <!-- PASSWORD TAB -->
                            <div class="tab-pane fade" id="password">

                                <form action="#" method="post">

                                    <div class="form-group">
                                        <label class="control-label">Nueva Contraseña</label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Repita la Nueva Contraseña</label>
                                        <input type="password" class="form-control">
                                    </div>

                                    <div class="col-lg-12">
                                        <a href="#" class="btn btn-primary"><i class="fa fa-check"></i> Cambiar contraseña</a>
                                        <!--<a href="#" class="btn btn-default">Cancel </a>-->
                                    </div>

                                </form>

                            </div>
                            <!-- /PASSWORD TAB -->

                            <!-- MASCOTAS TAB -->

                            <div class="tab-pane fade " id="mascotas">

                                <form action="#" method="post">

                                    <a href="#" onclick="toggler(&quot;mascota1&quot;)"><input class="btn" type="button" value="Mascota 1"></a>

                                    <a href="#" onclick="toggler(&quot;mascota2&quot;)"><input class="btn" type="button" value="Mascota 2"></a>

                                    <a href="#" onclick="toggler(&quot;mascota3&quot;)"><input class="btn" type="button" value="Mascota 3"></a>

                                    <div class="panel-body" id="mascota1" style="display: none;">

                                        <div class="form-group">
                                            <label class="control-label">Nombre</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Animal</label>
                                            <input type="text" class="form-control" value="Perro" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Raza</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Genero</label>
                                            <input type="text" class="form-control" value="Macho" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Tamaño</label>
                                            <select class="form-control">
                                                <option value="pequenyo">Pequeño</option>
                                                <option value="mediano">Mediano</option>
                                                <option value="grande">Grande</option>
                                                <option value="gigante">Gigante</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Edad</label>
                                            <input type="number" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Imagen de perfil</label>
                                            <div class="thumbnail ">
                                                <img class="img-responsive" src="storage/perro.jpg" alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="file" name="img">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <br><a href="#" class="btn btn-primary"><i class="fa fa-check"></i>Guardar Cambios</a>
                                            <!--<a href="#" class="btn btn-default">Cancel </a>-->
                                        </div>
                                    </div>

                                    <div class="panel-body" id="mascota2" style="display: none;">

                                        <div class="form-group">
                                            <label class="control-label">Nombre</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Animal</label>
                                            <input type="text" class="form-control" value="Perro" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Raza</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Genero</label>
                                            <input type="text" class="form-control" value="Macho" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Tamaño</label>
                                            <select class="form-control">
                                                <option value="pequenyo">Pequeño</option>
                                                <option value="mediano">Mediano</option>
                                                <option value="grande">Grande</option>
                                                <option value="gigante">Gigante</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Edad</label>
                                            <input type="number" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Imagen de perfil</label>
                                            <div class="thumbnail ">
                                                <img class="img-responsive" src="storage/gato.jpg" alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="file" name="img">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <br><a href="#" class="btn btn-primary"><i class="fa fa-check"></i>Guardar Cambios</a>
                                            <!--<a href="#" class="btn btn-default">Cancel </a>-->
                                        </div>
                                    </div>

                                    <div class="panel-body" id="mascota3" style="display: none;">

                                        <div class="form-group">
                                            <label class="control-label">Nombre</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Animal</label>
                                            <input type="text" class="form-control" value="Perro" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Raza</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Genero</label>
                                            <input type="text" class="form-control" value="Hembra" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Tamaño</label>
                                            <select class="form-control">
                                                <option value="pequenyo">Pequeño</option>
                                                <option value="mediano">Mediano</option>
                                                <option value="grande">Grande</option>
                                                <option value="gigante">Gigante</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Edad</label>
                                            <input type="number" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Imagen de perfil</label>
                                            <div class="thumbnail ">
                                                <img class="img-responsive" src="storage/perro2.jpg" alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="file" name="img">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <br><a href="#" class="btn btn-primary"><i class="fa fa-check"></i>Guardar Cambios</a>
                                            <!--<a href="#" class="btn btn-default">Cancel </a>-->
                                        </div>
                                    </div>


                                </form>
                            </div>


                            <!-- /MASCOTA TAB -->

                            <!-- PREMIUM TAB -->
                            <div class="tab-pane fade" id="premium">

                                <form action="#" method="post">
                                    <div class="sky-form">

                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                            <tr>
                                                <td>Premium</td>
                                                <td>
                                                    <label class="checkbox nomargin">
                                                        <input type="checkbox" name="checkbox"><i></i> Si
                                                    </label>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="">
                                        <a href="#" class="btn btn-primary"><i class="fa fa-check"></i> Guardar Cambios </a>
                                        <!--<a href="#" class="btn btn-default">Cancel </a>-->
                                    </div>
                                </form>
                            </div>
                            <!-- /PREMIUM TAB -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
