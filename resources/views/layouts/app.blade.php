<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:url"           content="https://www.animalslove.ml" />
    <meta property="og:type"          content="Animals Love" />
    <meta property="og:title"         content="AnimalsLove" />
    <meta property="og:description"   content="Red social de mascotas para personas" />
    <meta property="og:image"         content="https://www.animalslove.ml/storage/mascotas/1/20.jpeg" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{asset('css/micss.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.icon-large.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="shortcut icon" href="{{url('/')}}/storage/favicon.ico" type="image/x-icon">
    <link rel="icon" href="{{url('/')}}/storage/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
    <script>
        window.addEventListener("load", function(){
            window.cookieconsent.initialise({
                "palette": {
                    "popup": {
                        "background": "#e4fcf9",
                        "text": "#446491"
                    },
                    "button": {
                        "background": "#ace6f6",
                        "text": "#446491"
                    }
                },
                "theme": "edgeless",
                "content": {
                    "message": "Este sitio emplea cookies de Google  para analizar el tráfico. Google recibe información sobre tu uso de este sitio web. Si utilizas este sitio web, se sobreentiende que aceptas el uso de cookies.",
                    "dismiss": "Entiendo!",
                    "link": "Más información",
                    "href": "https://www.google.com/policies/technologies/cookies/"
                }
            })});
    </script>


    <!-- Scripts -->

    @yield('styles')


</head>
<body>

    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <input type="hidden" id="url" value="{{\Illuminate\Support\Facades\URL::to('/')}}">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        {{ config('app.name', 'AnimalsLove') }}

                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class="{{ Request::path() == 'home' || '' ? 'active' : '' }}"><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <span class="visible-xs"></span></a></li>
                    @if(!Auth::guest())
                        @if (Auth::user()->tipo == 1 || Auth::user()->tipo == 2)
                            <li class="{{ Request::is('editarperfil/*') ? 'active' : '' }}"><a href="{{ route('editarperfil.cuenta')}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> <span class="hidden-sm hidden-md">Editar Perfil</span></a></li>
                            @if(Auth::user()->tipo == 2)
                                <li class="{{ Request::path() == 'mensajes' ? 'active' : '' }}"><a href="{{ route('mensajes') }}"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <span class="hidden-sm hidden-md">Mensajes <span class="badge" id="count"></span></span></a></li>
                            @endif
                            <li class="{{ Request::path() == 'nuevapublicacion' ? 'active' : '' }}"><a href="{{route('nuevapublicacion')}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <span class="hidden-sm hidden-md"></span></a></li>
                            <li class="{{ Request::path() == 'administrar' ? 'active' : '' }}"><a href="{{route('administrar')}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <span class="hidden-sm hidden-md">Administrar</span></a></li>
                            <li class="{{ Request::path() == 'contacto' || '' ? 'active' : '' }}"><a href="{{ route('contacto') }}"><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> <span class="hidden-sm hidden-md">Contacto</span></a></li>
                                <li><form role="search" class="navbar-form navbar-left" action="{{route('filtro')}}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="text" name="b" id="busqueda" class="form-control">
                                            <button type="submit" class="btn btn-default btn-default btnColor"><span class="glyphicon glyphicon-search"></span></button>
                                        </div>
                                    </form>
                                </li>


                        @elseif(Auth::user()->tipo == 3)
                            <li class="{{ Request::path() == 'admin' ? 'active' : '' }}"><a href="{{route('admin')}}">Admin</a></li>
                        @endif
                    @else
                        <li class="{{ Request::path() == 'contacto' || '' ? 'active' : '' }}"><a href="{{ route('contacto') }}"><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> <span class="hidden-sm hidden-md">Contacto</span></a></li> <li><form role="search" class="navbar-form navbar-left" action="{{route('filtro')}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="text" name="b" id="busqueda" class="form-control">
                                        <button type="submit" class="btn btn-default btn-default btnColor"><span class="glyphicon glyphicon-search"></span></button>
                                    </div>
                                </form>
                            </li>
                    @endif

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                            <li><a href="{{ route('register') }}">Registrarse</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->login }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar Sesión
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="invisible">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @if(Session::has('message'))
            <p class="alert {{ \Illuminate\Support\Facades\Session::get('alert-class', 'alert-info') }}">{{ \Illuminate\Support\Facades\Session::get('message') }}</p>
        @endif
    </div>
        @yield('content')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    @if(!Auth::guest())
        <script>
            $url = $('#url').val();
            $.get({
                url: $url + '/cMensajes',
            }).done(function(data){
                $('#count').append(data);

            });
        </script>
    @endif
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    @yield('scripts')

<!-- <footer id="footer" style="margin-top: 15px;background-color:#d4d4d4">
    <div class="container">

        <div class="row margin-top-60 margin-bottom-40 size-13">


            <div class="col-md-4 col-sm-4">


            </div>
            <div class="col-md-8 col-sm-8">

                <div class="row">

                    <div class="col-md-3 hidden-sm hidden-xs">
                        <h4 class="letter-spacing-1">EXPLORA</h4>
                        <ul class="list-unstyled footer-list half-paddings noborder">
                            <li><a class="block" href="#"><i class="fa fa-angle-right"></i> Home</a></li>
                            <li><a class="block" href="#"><i class="fa fa-angle-right"></i> Login</a></li>
                            <li><a class="block" href="#"><i class="fa fa-angle-right"></i> Registro</a></li>
                            <li><a class="block" href="#"><i class="fa fa-angle-right"></i> Publicaciones</a></li>
                            <li><a class="block" href="#"><i class="fa fa-angle-right"></i> Mascotas</a></li>
                            <li><a class="block" href="#"><i class="fa fa-angle-right"></i> Contacto</a></li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <h4 class="letter-spacing-1">GRACIAS A</h4>

                            <img src="assets/images/cc/Visa.png" alt="" />
                            <img src="assets/images/cc/Mastercard.png" alt="" />
                            <img src="assets/images/cc/Maestro.png" alt="" />
                            <img src="assets/images/cc/PayPal.png" alt="" />
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="copyright">
        <div class="container">
            <ul class="pull-right nomargin list-inline mobile-block">
                <li><a href="#">Terminos &amp; Condiciones</a></li>
                <li>&bull;</li>
                <li><a href="#">Privacidad</a></li>
            </ul>

            ® 2017 Todos los derechos resevados
        </div>
    </div>

</footer> -->
</body>
</html>
