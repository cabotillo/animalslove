@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <!--Menu Principal -->
        <div class="col-sm-12">
            <div class="row">
                <h1 class="text-center">@if(isset($mensaje)) {{$mensaje}} @else Filtro avanzado @endif</h1>
            </div>

            <form method="post" action="{{route('filtrousuarios')}}">
                {{ csrf_field() }}
                <div class="col-md-6">
                    <label class="control-label">Usuario</label>
                    <input class="form-control" type="text" name="usuario">
                </div>
                <div class="col-md-6">
                    <label class="control-label">Provincia</label>
                    <select class="form-control" name="provincia">

                        @foreach($provincias as $p)
                            <option @if( old('provincia') == $p->id) selected="selected" @endif value="{{$p->id}}">{{$p->provincia}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 bntEnviar">
                    <input class="btn btn-primary" type="submit" value="Filtrar">
                </div>

            </form>

            @if(!empty($usuarios[0]))

                <h2 class="text-center">Hay {{count($usuarios)}} usuarios:</h2>
                <div class="col-md-12">
                @foreach($usuarios as $u)
                    <a href="{{'perfil/',$u->login}}{{$u->login}}">
                        <div class="col-sm-4 col-md-3">
                            <p>{{$u->nombre}}</p>
                            <img alt="{{$u->nombre}}" src="storage/{{$u->avatar}}" class="img-responsive imgmascotas">
                        </div>
                    </a>
                @endforeach
                </div>
            @endif


            @if(!empty($mascotas[0]))

                <h2 class="text-center">Hay {{count($mascotas)}} mascota(s): </h2>
                <div class="col-md-12">
                    @foreach($mascotas as $m)

                        <a href="{{'mascota/',$m->id}}{{$m->id}}"><div class="mascota @if($m->genero == 'Macho') macho @else hembra @endif col-sm-4 col-md-3">
                                <p>{{$m->nombre}}</p>
                                <img alt="{{$m->nombre}}" src="storage/{{$m->avatar}}" class="img-responsive imgmascotas">

                            </div></a>
                    @endforeach
                </div>

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

