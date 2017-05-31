@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($mensaje))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ $mensaje }}
        </div>
    @endif
    <!-- 1 menu -->

    <div class="col-sm-12">

        <div class="row" style="display:flex;justify-content:center;align-items:center;">
            <!--<div class="col-md-4"><img src="storage/perro.jpg" alt="logo" style="width:250px;"></div>-->
            <div class="col-md-2" style="align-items: center"><button type="button" id="menu"><span class="glyphicon glyphicon-align-justify"></span></button></div>
            <h1 class="text-center">SLOGAN SUPER MEGA CHULO</h1>
        </div>
    </div>


    <!--Menu Principal -->
    <div class="col-sm-12">

        <div class="row">

            <ul class="nav nav-tabs">
                <li class="active" id="mascotas_ref" role="presentation"><a href="#mascotas" class="inf"><h2>Mascotas</h2></a></li>
                <li id="publicaciones_ref" role="presentation"><a href="#publicaciones" class="inf"><h2>Publicaciones</h2></a></li>
            </ul>
        </div>

        <div class="row">
            <div id="buscar" class="col-sm-3 oculto">

                    @if(Auth::user())<h1><a href="{{'perfil/',Auth::user()->login}}{{Auth::user()->login}}">Mi perfil</a></h1>@endif
                    <h1><small>Filtrar Mascotas</small></h1>
                    <form method="post" action="{{route('busqueda')}}">
                        {{ csrf_field() }}
                        <label class="control-label">Animal</label>
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
                            <label class="control-label">Genero</label><br>
                            <label class="radio-inline"><input type="radio" name="genero" value="Macho"> Macho</label>
                            <label class="radio-inline"><input type="radio" name="genero" value="Hembra"> Hembra</label>
                            @if ($errors->has('genero'))
                                <span class="help-block">
                                <strong>{{ $errors->first('genero') }}</strong>
                            </span>
                            @endif
                        </div>
                        <input class="btn btn-primary" type="submit" value="Filtrar">
                    </form>

            </div>
            <div id="menumascotas" class="col-sm-12">
                <div class="row oculto" id="mascotas">
                    @foreach($mascotas as $m)

                        <a href="{{'mascota/',$m->id}}{{$m->id}}"><div class="mascota @if($m->genero == 'Macho') macho @else hembra @endif col-sm-4 col-md-3">
                            <p>{{$m->nombre}}</p>
                                <img alt="{{$m->nombre}}" src="storage/{{$m->avatar}}" class="img-responsive" style="max-height: 200px;max-width: 200px">

                        </div></a>
                    @endforeach

                    <div class="col-md-12">{{ $mascotas->links() }}</div>
                </div>


                <div class="row oculto" id="publicaciones">

                    @foreach($publicaciones as $p)
                        <a href="{{'publicacion/',$p->id}}{{$p->id}}">
                        <div class="col-md-6">
                            <h4>{{$p->titulo}}</h4>
                            <p>{{$p->cuerpo}}</p>
                        </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')

<style>

    A:link, A:visited, A:active {
         color:#636b6f;
    }
    .form-group {
        margin-bottom: 15px !important;
    }

    #mascotas{
        text-align: center;
        align-items:center;
    }

    .macho{
        border: 1px solid lightskyblue;margin: 15px;
    }
    .hembra{
        border: 1px solid lightpink;margin: 15px;
    }
    .mascota{
        width: 17%;
        min-height: 200px;
        min-width: 250px;
    }

    .img-responsive{
        margin:auto;
    }

</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){

        //Cambiar entre mascotas y publicaciones

        $(".oculto").hide();
        $("#mascotas").show();
        $(".inf").click(function(){
            var nodo = $(this).attr("href");
            $("#mascotas_ref").toggleClass('active');
            $("#publicaciones_ref").toggleClass('active');
            if ($(nodo).is(":visible")){
                $(nodo).hide();
                return false;
            }else{

                $(".oculto").hide();
                $(nodo).fadeToggle("fast");

                return false;
            }
        });
        $('#busqueda').click(function () {
            var nodo = $(this).attr("href");
            $("#buscar").toggleClass('active');
            if ($(nodo).is(":visible")){
                $(nodo).hide();
                return false;
            }else{

                $("#buscar").hide();
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
<script>
    $(document).ready(function(){
        $('#menu').click('click', function() {
            $('#buscar').toggle('show');
            $("#menumascotas").toggleClass('col-sm-12');
            $("#menumascotas").toggleClass('col-sm-9');
        });
    });
</script>
@endsection

