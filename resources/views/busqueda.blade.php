@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <!--Menu Principal -->
        <div class="col-sm-9">
            <div class="row">
                <h1 class="text-center">{{$tipo}}</h1>

                @if(empty($resultados))

                        <h2>{{$mensaje}}</h2>
                    </div>
                @else
            </div>

                <div class="row" id="">
                    <h2>{{$mensaje}}</h2>
                    @foreach($resultados as $r)
                        <div class="mascotas col-sm-9 col-md-3">
                            <a class="textDeco" href="{{'mascota/',$r->id}}{{$r->id}}"><p>{{$r->nombre}}</p>
                                <img alt="{{$r->nombre}}" src="storage/{{$r->avatar}}" class="img-responsive">
                                <p>{{$r->animal}}</p>
                                <p>{{$r->raza}}</p>
                                <p>{{$r->genero}}</p></a>
                        </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
@endsection

@section('scripts')

    <script>

    //Flitrar mascotas

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



    </script>
    @endsection

