@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="text-center">Imagenes de {{$mascota->nombre}}</h1>
        <form method="post" action="{{route('imagenes',$mascota->id)}}">
            {{csrf_field()}}
        @foreach($imagenes as $i)
            <div class="col-md-2">
            <img src="../storage/{{$i->imagen}}" class="img-responsive">
                <input class="btn btn-danger" type="submit" value="Eliminar Foto">
                <input type="hidden" name="id" value="{{$i->id}}">
            </div>

        @endforeach
        </form>
    </div>

    <div class="row">
        <h1>Subir fotos nuevas</h1>
        <div class="panel panel-primary">
            <div class="panel-heading">
                Dropzone
            </div>
            <div class="panel-body">

                <form action="." id="my-dropzone" class="dropzone" method="post" enctype="multipart/form-data">
                    <div class="dz-message" style="height:200px;">
                        Drop your files here
                    </div>
                    <div class="dropzone-previews"></div>
                    <button type="submit" class="btn btn-success" id="submit">Save</button>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
    <script src="../js/dropzone.js"></script>
    <script>

        Dropzone.options.myDropzone = {
            autoProcessQueue: false,
            uploadMultiple: true,
            maxFilezise: 10,
            maxFiles: 2,

            init: function() {
                var submitBtn = document.querySelector("#submit");
                myDropzone = this;

                submitBtn.addEventListener("click", function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });
                this.on("addedfile", function(file) {
                    alert("file uploaded");
                });

                this.on("complete", function(file) {
                    myDropzone.removeFile(file);
                });

                this.on("success",
                    myDropzone.processQueue.bind(myDropzone)
                );
            }
        };
    </script>
@endsection