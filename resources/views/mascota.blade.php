@extends('layouts.app')
@section('styles')
<style>

    .hide-bullets {
        list-style:none;
        margin-left: -40px;
        margin-top:20px;
    }

    .thumbnail {
        padding: 0;
    }

    .carousel-inner>.item>img, .carousel-inner>.item>a>img {
        width: 100%;
    }
</style>
@endsection
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
        <h1 class="text-center">{{$mascota->nombre}}</h1>
    <div class="row col-sm-4">
        <div class="thumbnail">
            <img alt="{{$mascota->nombre}}" src="../storage/{{$mascota->avatar}}" class="img-responsive" data-holder-rendered="true">
            <div class="caption">
                @if(!Auth::guest())
                    @if(Auth::user()->id == $usuario->id)
                        <a href="../editar/mascota/{{$mascota->id}}" class="btn btn-primary">Editar Mascota</a>
                        <a href="{{route('imagenes',$mascota->id)}}" class="btn btn-primary">Añadir Fotos</a>
                    @endif
                @endif
                <div class="input-group desc">
                    <br><span class="input-group-addon">{{$icono}}</span>
                    <p class="form-control infoUsu">{{$mascota->raza}}</p>
                    <span class="input-group-addon">{{$genero}}</span>
                </div>
                <a href="{{'../perfil/',$usuario->id}}{{$usuario->login}}" class="textDeco">
                    <div class="input-group desc">
                        <span class="input-group-addon">&#128513;</span>
                        <p class="form-control infoUsu">{{$usuario->login}}</p>
                    </div>
                </a><br>
                    <span>Edad: {{$mascota->edad}} años</span><br>
                    <span>Tamaño: {{$mascota->tamanyo}}</span><br>
            </div>
        </div>
    @if(!empty($publicaciones->first()))
            <h2>Publicaciones</h2>

        @foreach($publicaciones as $p)

            <div class="media col-sm-12">
                <h3 class="media-heading">{{$p->titulo}}</h3>
                <p>{{$p->cuerpo}}</p>
            </div>
        @endforeach

    @endif
    </div>

    <div class="col-md-8">

        @if(!empty($imagenes->first() && Auth::check()))
            <h2>Galeria de imagenes</h2>

            <div class="row">
                <div class="col-sm-6" id="slider-thumbs">
                    <ul class="hide-bullets">
                        @for($i = 0; $i < count($imagenes); $i++)
                            <li class="col-sm-3">
                                <a class="thumbnail" id="carousel-selector-{{$i}}">
                                    <img alt="galeria animal" src="../storage/mascotas/{{$imagenes[$i]->imagen}}">
                                </a>
                            </li>
                        @endfor
                    </ul>
                </div>
                <div class="col-sm-6">
                    <div class="col-xs-12" id="slider">
                        <div class="row">
                            <div class="col-sm-12" id="carousel-bounding-box">
                                <div class="carousel slide" id="myCarousel">
                                    <div class="carousel-inner">
                @for($i = 0; $i < count($imagenes); $i++)
                    @if($i == 0)
                        <div class="item active" data-slide-number="{{$i}}">
                            <img alt="mascota" src="../storage/mascotas/{{$imagenes[$i]->imagen}}">
                        </div>
                    @else
                        <div class="item " data-slide-number="{{$i}}">
                            <img alt="mascota" src="../storage/mascotas/{{$imagenes[$i]->imagen}}">
                        </div>
                    @endif
                @endfor

                </div>
                <!-- Carousel nav -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a></div></div></div></div></div></div>
        @endif

        @if(!Auth::check())
            <h2>Solo los usuarios registrados pueden ver la galería de fotos.</h2>
       @endif
    </div>
</div>

@endsection

@section('scripts')
<script>
    jQuery(document).ready(function($) {

    $('#myCarousel').carousel({
    interval: 5000
    });

    //Handles the carousel thumbnails
    $('[id^=carousel-selector-]').click(function () {
    var id_selector = $(this).attr("id");
    try {
    var id = /-(\d+)$/.exec(id_selector)[1];
    jQuery('#myCarousel').carousel(parseInt(id));
    } catch (e) {
    }
    });
    // When the carousel slides, auto update the text
    $('#myCarousel').on('slid.bs.carousel', function (e) {
    var id = $('.item.active').data('slide-number');
    $('#carousel-text').html($('#slide-content-'+id).html());
    });
    });

</script>

    @endsection
