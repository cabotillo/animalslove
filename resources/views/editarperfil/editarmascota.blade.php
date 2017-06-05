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
                            <li class="active"><a href="{{'../../mascotas'}}">Añadir Mascota</a></li>
                            <li><a href="{{'../../premium'}}">Premium</a></li>
                        </ul>

                        <form action="{{route('editarperfil.editarmascota',$mascota->id)}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class=" row panel-body">

                                <div class="form-group">
                                    <label class="control-label">Nombre</label>
                                    <input type="text" class="form-control" value="{{$mascota->nombre}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Animal</label>
                                    <input type="text" class="form-control" value="{{$mascota->animal}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Raza</label>
                                    <input type="text" class="form-control" value="{{$mascota->raza}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Genero</label>
                                    <input type="text" class="form-control" value="{{$mascota->genero}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Tamaño</label>
                                    <select class="form-control" name="tamanyo">
                                        <option @if($mascota->tamanyo == 'Pequeño') selected = "selected" @endif value="Pequeño">Pequeño</option>
                                        <option @if($mascota->tamanyo == 'Mediano') selected = "selected" @endif value="Mediano">Mediano</option>
                                        <option @if($mascota->tamanyo == 'Grande') selected = "selected" @endif value="Grande">Grande</option>
                                        <option @if($mascota->tamanyo == 'Gigante') selected = "selected" @endif value="Gigante">Gigante</option>

                                    </select>


                                </div>
                                <div class="form-group">
                                    <label class="control-label">Edad</label>
                                    <input type="number" class="form-control" value="{{$mascota->edad}}" name="edad">
                                    @if ($errors->has('edad'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('edad') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Imagen de perfil</label>
                                    <div class="thumbnail ">
                                        <img class="img-responsive" src="../../../storage/{{$mascota->avatar}}" alt="{{$mascota->nombre}}" id="avatar">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="file" name="img" id="file">
                                    </div>
                                </div>
                                <div class="col-md-12">
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