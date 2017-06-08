@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Registro</div>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="col-md-6 form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                        <label for="nombre" class="col-md-4 control-label">Nombre</label>

                        <div class="col-md-6">
                            <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required autofocus data-toggle="tooltip" data-placement="right" title="De 3 a 25 caracteres">

                            @if ($errors->has('nombre'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nombre') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6 form-group{{ $errors->has('apellidos') ? ' has-error' : '' }}">
                        <label for="apellidos" class="col-md-4 control-label">Apellidos</label>

                        <div class="col-md-6">
                            <input id="apellidos" type="text" class="form-control" name="apellidos" value="{{ old('apellidos') }}" required autofocus data-toggle="tooltip" data-placement="right" title="De 3 a 50 caracteres">

                            @if ($errors->has('apellidos'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('apellidos') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6 form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                        <label for="login" class="col-md-4 control-label">Nombre de usuario</label>

                        <div class="col-md-6">
                            <input id="login" type="text" class="form-control" name="login" value="{{ old('login') }}" required autofocus data-toggle="tooltip" data-placement="right" title="De 3 a 20 caracteres">

                            @if ($errors->has('login'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('login') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">Correo electrónico</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required data-toggle="tooltip" data-placement="right" title="De 6 a 50 caracteres">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Contraseña</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required data-toggle="tooltip" data-placement="right" title="8 caracteres o más, letra minuscula y un numero ">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="col-md-6 form-group{{ $errors->has('provincia') ? ' has-error' : '' }}">
                        <label for="provincia" class="col-md-4 control-label">Provincia</label>

                        <div class="col-md-6">
                            <select class="form-control" name="provincia">

                                @foreach($provincias as $p)
                                    <option @if( old('provincia') == $p->id) selected="selected" @endif value="{{$p->id}}">{{$p->provincia}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('provincia'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('provincia') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                        <label for="telefono" class="col-md-4 control-label">Teléfono</label>
                        <div class="col-md-6">
                            <input id="telefono" type="number" class="form-control" name="telefono" value="{{ old('telefono') }}" required autofocus>

                            @if ($errors->has('telefono'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('telefono') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6 form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                        <label for="g-recaptcha-response" class="col-md-4 control-label">Captcha</label>
                        <div class="col-md-6">
                            {!! \Recaptcha::render() !!}
                        </div>
                    </div>

                    <div class="col-md-12 form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Registrarse
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $('input[title]').tooltip({'trigger':'focus'});

        $("input#login, input#email, input#password").on({
            keydown: function(e) {
                if (e.which === 32)
                    return false;
            },
            change: function() {
                this.value = this.value.replace(/\s/g, "");
            }
        });

    </script>
@endsection
