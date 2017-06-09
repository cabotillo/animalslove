@extends('layouts.app')

@section('content')

    <div class="container">
        @if(isset($_GET['u']))
            @if($_GET['u'] == 1)
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    La mascota ha sido editada correctamente con su avatar
                </div>
            @elseif($_GET['u'] == 0)
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Se ha producido un error. Vuelve a intentarlo más tarde
                </div>
            @endif
        @endif
        <h1 class="text-center">Perfil de {{$mascota->nombre}}</h1>

            <form action="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel-body">
                    <div class="col-sm-6 form-group {{ $errors->has('edad') ? ' has-error' : '' }}">
                        <label class="control-label">Edad</label>
                        <input type="number" class="form-control" value="{{$mascota->edad}}" name="edad">
                        @if ($errors->has('edad'))
                            <span class="help-block">
                                <strong>{{ $errors->first('edad') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-6 form-group" {{ $errors->has('tamanyo') ? ' has-error' : '' }}>
                        <label class="control-label">Tamaño</label>
                        <select class="form-control" name="tamanyo">
                            <option @if($mascota->tamanyo == 'Pequeño')selected = "selected" @endif value="Pequeño">Pequeño</option>
                            <option  @if($mascota->tamanyo == 'Mediano')selected = "selected" @endif value="Mediano">Mediano</option>
                            <option  @if($mascota->tamanyo == 'Grande')selected = "selected" @endif value="Grande">Grande</option>
                            <option  @if($mascota->tamanyo == 'Gigante')selected = "selected" @endif value="Gigante">Gigante</option>

                        </select>
                        @if ($errors->has('tamanyo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tamanyo') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="col-sm-12 form-group">
                        <label class="control-label">Imagen de perfil</label><br>

                        <div class="thumbnail col-md-6">
                            <img src="../../../storage/{{$mascota->avatar}}" alt="avatar" id="foto">
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



@endsection

@section('scripts')
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