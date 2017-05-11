@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">


        <!-- Menu izquierdo -->
        <div class="col-sm-3">
            <div id="buscar">
                @if(Auth::user())<h1><a href="{{'perfil/',Auth::user()->login}}{{Auth::user()->login}}">Mi perfil</a></h1>@endif
                <h1><small>Filtrar Mascotas</small></h1>
                <form method="post" action="{{route('busqueda')}}">
                    {{ csrf_field() }}
                <select class="form-control" name="animal" id="animal">
                    <option selected="selected">Selecciona</option>
                    @foreach($animales as $a)
                        <option value="{{$a->id}}">{{$a->animal}}</option>
                    @endforeach
                </select>

                <span>Raza</span>
                <select class="form-control" name="raza" id="raza"></select>

                <span>Genero</span>
                    <div class="radio"><label><input type="radio" name="genero" value="Macho"> Macho</label></div>
                    <div class="radio"><label><input type="radio" name="genero" value="Hembra"> Hembra</label></div>
                    <br><input class="form-control" type="button" value="Filtrar" name="submit">
                </form>


            </div>


        </div>

        <!--Menu Principal -->
        <div class="col-sm-9">
            <div class="row">
                <h1 class="text-center">{{$tipo}}</h1>

            </div>


                <div class="row" id="">

                    @foreach($resultados as $r)
                        <div class="mascotas col-sm-9 col-md-3" id="" style="border: 1px solid #98cbe8">
                            <a style="text-decoration: none" href="{{'mascota/',$r->id}}{{$r->id}}"><p>{{$r->nombre}}</p>
                                <img alt="{{$r->nombre}}" src="storage/{{$r->avatar}}" class="img-responsive">
                                <p>{{$r->animal}}</p>
                                <p>{{$r->raza}}</p>
                                <p>{{$r->genero}}</p></a>
                        </div>
                    @endforeach
                </div>
            </div>
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

