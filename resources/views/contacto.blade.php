@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row col-md-8 col-md-offset-2">
        @if(isset($mensaje))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ $mensaje }}
            </div>
        @endif
        <h1>Formulario de contacto</h1>
                <form role="form" action="{{route('contacto')}}" method="post">
                    {{ csrf_field() }}

                    @if (Auth::guest())

                    <input type="hidden" value="invitado" name="usu">
                    <div class="nombre form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                        <label class="control-label">Nombre *</label>
                        <input class="form-control" type="text" name="nombre">
                        @if ($errors->has('nombre'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class=" form-group{{ $errors->has('correo') ? ' has-error' : '' }}">
                        <label class="control-label">Correo Electrónico *</label>
                        <input class="form-control" type="text" name="correo">
                        @if ($errors->has('correo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('correo') }}</strong>
                            </span>
                        @endif
                    </div>
                    @else <input type="hidden" value="usuario" name="usu"> @endif
                    <div class=" form-group{{ $errors->has('asunto') ? ' has-error' : '' }}">
                        <label class="control-label">Asunto</label>
                        <input class="form-control" type="text" name="asunto">
                        @if ($errors->has('asunto'))
                            <span class="help-block">
                                <strong>{{ $errors->first('asunto') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('cuerpo') ? ' has-error' : '' }}">
                        <label class="control-label">Mensaje *</label>
                        <textarea class="form-control" name="cuerpo" value="{{old('cuerpo')}}"></textarea>
                        @if ($errors->has('cuerpo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('cuerpo') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                        <label for="g-recaptcha-response" class="col-md-4 control-label">Captcha</label>
                        <div class="col-md-6">
                            {!! \Recaptcha::render() !!}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-primary" value="Enviar Mensaje">
                    </div>
                </form>
            </div>
        </div>
@endsection

@section('scripts')
    <script>
    $( document ).ready(function() {
        $('.login').hide();
    });

    $("input[name='invi']").change(function(){
        $('.login').toggle();
        $('.nombre').toggle();
    });
    </script>
@endsection
