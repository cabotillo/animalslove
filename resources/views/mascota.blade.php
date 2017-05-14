@extends('layouts.app')

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
@section('content')
<div class="container">
    @if(isset($mensaje))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ $mensaje }}
        </div>
    @endif
        <h1 class="text-center">{{$mascota->nombre}}</h1>
    <div class="row col-sm-4">
        <div class="thumbnail">
            <img alt="{{$mascota->nombre}}" src="../storage/{{$mascota->avatar}}" class="img-responsive" data-holder-rendered="true">
            <div class="caption">
                <p>{{$mascota->animal}}</p>
                <p>{{$mascota->raza}}</p>
                <p>{{$mascota->genero}}</p>
                <p>Pertenece a <a href="{{'../perfil/',$usuario->id}}{{$usuario->login}}">{{$usuario->login}}</a></p>
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

        @if(!empty($imagenes->first()))
            <h2>Galeria de imagenes</h2>

            <div class="row">
                <div class="col-sm-6" id="slider-thumbs">
                    <ul class="hide-bullets">
                        @for($i = 0; $i < count($imagenes); $i++)
                            <li class="col-sm-3">
                                <a class="thumbnail" id="carousel-selector-{{$i}}">
                                    <img src="../storage/{{$imagenes[$i]->Imagen}}">
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
                                    <img src="../storage/{{$imagenes[$i]->Imagen}}">
                                </div>
                                        @else
                                            <div class="item " data-slide-number="{{$i}}">
                                                <img src="../storage/{{$imagenes[$i]->Imagen}}">
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
                </a></div></div></div></div></div></div></div>
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