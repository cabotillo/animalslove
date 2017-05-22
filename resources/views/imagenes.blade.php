@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="text-center">Imágenes de {{$mascota->nombre}}</h1>
        <div class="alert alert-success" id="verde" hidden="hidden">
            Imágenes subidas correctamente
        </div>
        @foreach($imagenes as $i)
            <div class="col-md-2">
            <img src="../storage/mascotas/{{$i->imagen}}" class="img-responsive">
                <form method="post" action="{{route('imagenesdelete',$i->id)}}">
                    {{csrf_field()}}
                <input class="btn btn-danger" type="submit" value="Eliminar Foto">
                <input type="hidden" name="id" value="{{$i->imagen}}">
                </form>
            </div>
        @endforeach
    </div>
    <hr>
    <div class="panel panel-info">
        <div class="panel-heading">
            Sube nuevas fotos para la galería de imágenes
        </div>
        <div class="panel-body">
            <form action="../imagenesadd/{{$mascota->id}}" enctype="multipart/form-data" method="post" id="my-dropzone" class="dropzone">
                {{csrf_field()}}
                <div class="dropzone-previews"></div>
                <button type="submit" class="btn btn-success" id="submit">GUARDAR</button>
            </form>
        </div>
    </div>


</div>



@endsection

@section('scripts')
<script src="../js/dropzone.js"></script>
<script>
    Dropzone.options.myDropzone = {
        acceptedFiles: 'image/*',
        autoProcessQueue: false,
        uploadMultiple: true,
        maxFilezise: 10,
        maxFiles: 2,
        addRemoveLinks: true,

        init: function() {
            var submitBtn = document.querySelector("#submit");
            myDropzone = this;

            submitBtn.addEventListener("click", function(e){
                e.preventDefault();
                e.stopPropagation();
                myDropzone.processQueue();
            });
            this.on("addedfile", function(file) {
                //alert("file uploaded");
            });

            this.on("complete", function(file) {
                myDropzone.removeFile(file);
                $("#verde").show().delay(5000).fadeOut();
                location.reload().delay(8000).fadeOut();
            });

            this.on("success",
                myDropzone.processQueue.bind(myDropzone)
            );
        }
    };
</script>

@endsection