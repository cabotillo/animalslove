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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.icon-large.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

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
                    @if (!Auth::guest())

                        <li class="{{ Request::path() == 'home' || '' ? 'active' : '' }}"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="{{ Request::path() == 'editarperfil/cuenta' ? 'active' : '' }}"><a href="{{ route('editarperfil.cuenta')}}">Editar Perfil</a></li>
                        <!--<li><a href="">Mi Perfil</a></li>-->
                        @if(Auth::user()->tipo == 2 || Auth::user()->tipo == 3)<li class="{{ Request::path() == 'mensajes' ? 'active' : '' }}"><a href="{{ route('mensajes') }}">Mensajes <span class="badge" id="count"></span></a></li>@endif
                        <li class="{{ Request::path() == 'nuevapublicacion' ? 'active' : '' }}"><a href="{{route('nuevapublicacion')}}">Nueva Publicación</a></li>
                        @if(Auth::user()->tipo == 3)<li class="{{ Request::path() == 'admin' ? 'active' : '' }}"><a href="{{route('admin')}}">Admin</a></li>@endif
                        @else
                            <li><a href="{{ route('home') }}">Inicio</a></li>
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

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
        <style>
            #count{
                background: red;
            }
        </style>
    @endif

    @yield('scripts')
    @yield('styles')
</body>
</html>
