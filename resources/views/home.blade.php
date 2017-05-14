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

                <div class="form-group{{ $errors->has('raza') ? ' has-error' : '' }}">
                    <label class="control-label">Raza</label>
                    <select class="form-control" name="raza" id="raza"></select>
                    @if ($errors->has('raza'))
                        <span class="help-block">
                            <strong>{{ $errors->first('raza') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('genero') ? ' has-error' : '' }}">
                    <label class="control-label">Genero</label>
                    <div class="radio"><input type="radio" name="genero" value="Macho"> Macho</div>
                    <div class="radio"><input type="radio" name="genero" value="Hembra"> Hembra</div>
                    @if ($errors->has('genero'))
                        <span class="help-block">
                            <strong>{{ $errors->first('genero') }}</strong>
                        </span>
                    @endif
            </div>
                    <br><input class="btn btn-primary" type="submit" value="Filtrar">
                </form>


            </div>


        </div>

        <!--Menu Principal -->
        <div class="col-sm-9">
            <div class="row">
                <h1 class="text-center">SLOGAN SUPER MEGA CHULO</h1>
                <ul class="nav nav-tabs">
                    <a href="#mascotas" class="inf"><li id="mascotas_ref" role="presentation" class="active"><h2>Mascotas</h2></a></li>
                    <a href="#publicaciones" class="inf"><li id="publicaciones_ref" role="presentation"><h2>Publicaciones</h2></a></li>
                </ul>
            </div>


                <div class="row oculto" id="mascotas">

                    @foreach($mascotas as $m)
                        <div class="mascotas col-sm-9 col-md-3" id="" style="border: 1px solid #98cbe8">
                            <a style="text-decoration: none" href="{{'mascota/',$m->id}}{{$m->id}}"><p>{{$m->nombre}}</p>
                                <img alt="{{$m->nombre}}" src="storage/{{$m->avatar}}" class="img-responsive">
                                <p>{{$m->animal}}</p>
                                <p>{{$m->raza}}</p>
                                <p>{{$m->genero}}</p></a>
                        </div>
                    @endforeach
                </div>

                <div class="row oculto" id="publicaciones">

                    @foreach($publicaciones as $p)
                        <div class="media col-sm-6 col-md-6">
                            <div class="media-left"> <a href="#">
                                    <img alt="animal" class="media-object" src="storage/mascotas/avatar.jpg" data-holder-rendered="true" style="width: 64px; height: 64px;"> </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{$p->titulo}}</h4>
                                {{$p->cuerpo}}
                            </div>

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

        $(document).ready(function(){

            //Cambiar entre mascotas y publicaciones

            $(".oculto").hide();
            $("#mascotas").show();
            $(".inf").click(function(){
                var nodo = $(this).attr("href");

                if ($(nodo).is(":visible")){
                    $(nodo).hide();
                    return false;
                }else{

                    $(".oculto").hide();
                    $(nodo).fadeToggle("fast");

                    return false;
                }
            });

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
        });


    </script>
    @endsection

