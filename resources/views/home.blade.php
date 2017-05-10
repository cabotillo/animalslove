@extends('layouts.app')

@section('content')
<div class="container" xmlns:border="http://www.w3.org/1999/xhtml">

    <div class="row">

        <!-- Menu izquierdo -->
        <div class="col-sm-3">
            <div id="buscar">
                @if(Auth::user())<h1><a href="{{'perfil/',Auth::user()->login}}{{Auth::user()->login}}">Mi perfil</a></h1>@endif
                <h1><small>Filtrar Mascotas</small></h1>
                <form method="post" action="">
                <span>Animal</span>
                <select class="form-control" name="animal">
                    @foreach($animales as $a)
                        <option @if( old('animal') == $a->id) selected="selected" @endif value="{{$a->id}}">{{$a->nombre}}</option>
                    @endforeach
                </select>

                <span>Raza</span>
                <select class="form-control" name="raza">
                    @foreach($razas as $r)
                        <option @if( old('raza') == $r->id) selected="selected" @endif value="{{$r->id}}">{{$r->nombre}}</option>
                    @endforeach
                </select>

                <span>Sexo</span>
                <select class="form-control" name="genero">
                    <option value="Macho">Macho</option>
                    <option value="Hembra">Hembra</option>
                </select>

                    <br><input class="form-control" type="button" value="Filtrar" name="submit">
                </form>


            </div>


        </div>

        <!--Menu Principal -->
        <div class="col-sm-9">
            <div class="row">
                <h1 class="text-center">SLOGAN SUPER MEGA CHULO</h1>
            </div>
            <div class="row" id="mascotas">

                @foreach($mascotas as $m)
                    <div class="mascotas col-sm-3" id="{{$m->animal_id}}" style="border: 1px solid #98cbe8">
                        <a style="text-decoration: none" href="{{'mascota/',$m->id}}{{$m->id}}"><p>{{($m)->nombre}}</p>
                        <img src="storage/{{$m->avatar}}" class="img-responsive">
                        <p>{{($m)->animal_id}}</p>
                        <p>{{($m)->raza_id}}</p>
                        <p>{{($m)->genero}}</p></a>
                    </div>
                @endforeach

            </div>
        </div>
</div>
    </div>
</div>
@endsection
