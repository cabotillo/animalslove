@extends('layouts.app')

@section('content')
    <div class="container">
        @if(isset($_GET['u']))
            @if($_GET['u'] == 1)
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    La mascota ha sido añadida correctamente
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
                            <li class="active"><a href="{{'../mascotas'}}">Añadir Mascota</a></li>
                            <li><a href="{{'premium'}}">Premium</a></li>
                        </ul>
                        <form action="" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="panel-body">

                                <div class="col-sm-6 form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                                    <label class="control-label">Nombre</label>
                                    <input type="text" class="form-control" value="{{old('nombre')}}" name="nombre">
                                    @if ($errors->has('nombre'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-6 form-group {{ $errors->has('edad') ? ' has-error' : '' }}">
                                    <label class="control-label">Edad</label>
                                    <input type="number" class="form-control" value="{{old('edad')}}" name="edad">
                                    @if ($errors->has('edad'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('edad') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="control-label">Animal</label>
                                    <select class="form-control" name="animal" id="animal">
                                        <option selected="selected"></option>
                                        @foreach($animales as $a)
                                            <option value="{{$a->id}}">{{$a->animal}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-sm-6 form-group {{ $errors->has('raza') ? ' has-error' : '' }}">
                                    <label class="control-label">Raza</label>
                                    <select class="form-control" name="raza" id="raza"></select>
                                    @if ($errors->has('raza'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('raza') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-6 form-group {{ $errors->has('genero') ? ' has-error' : '' }}">
                                    <label class="control-label">Genero</label>
                                    <select class="form-control" name="genero" id="genero">
                                        <option value="Macho">Macho</option>
                                        <option value="Hembra">Hembra</option>
                                    </select>
                                    @if ($errors->has('genero'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('genero') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="control-label">Tamaño</label>
                                    <select class="form-control" name="tamanyo">
                                        <option selected = "selected" value="Pequeño">Pequeño</option>
                                        <option  value="Mediano">Mediano</option>
                                        <option  value="Grande">Grande</option>
                                        <option  value="Gigante">Gigante</option>

                                    </select>


                                </div>
                                <div class="col-sm-12 form-group">
                                    <label class="control-label">Imagen de perfil</label><br>

                                    <div class="thumbnail col-md-6">
                                        <img src="" alt="avatar" id="foto">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="file" name="img" id="file">
                                    </div>
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

@section('scripts')
<script>
    //Flitrar mascotas

    $(document).ready(function(){
        $('#animal').prepend('');

        $('#animal').on('change',function (e) {

        var animal_id = e.target.value;

        if(animal_id){
            $.ajax({
                type: "GET",
                url: "{{url('filtrar')}}?animal_id=" + animal_id,
                success: function (res) {
                    if(res){
                        $("#raza").empty();
                        $.each(res, function (key, value) {
                            $("#raza").append('<option value="' + key + '">' + value + '</option>');
                        });
                    }else{
                        $("#raza").empty();
                    }
                }
            });
        }
        });
    });
</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#foto').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#file").change(function(){
        readURL(this);
    });

</script>
@endsection