@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-12"><h1>Formulario de contacto</h1></div>


    <form action="{{route('contacto')}}" method="post">
        {{ csrf_field() }}
    @if(isset($mensaje))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ $mensaje }}
        </div>
    @endif

        @if (Auth::guest())

        <input type="hidden" value="invitado" name="usu">
        <div class="col-md-6 nombre form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
            <label class="control-label">Nombre *</label>
            <input class="form-control" type="text" name="nombre" value="{{old('nombre')}}">
            @if ($errors->has('nombre'))
                <span class="help-block">
                    <strong>{{ $errors->first('nombre') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-md-6 form-group{{ $errors->has('correo') ? ' has-error' : '' }}">
            <label class="control-label">Correo Electrónico *</label>
            <input class="form-control" type="text" name="correo" value="{{old('correo')}}">
            @if ($errors->has('correo'))
                <span class="help-block">
                    <strong>{{ $errors->first('correo') }}</strong>
                </span>
            @endif
        </div>
        @else <input type="hidden" value="usuario" name="usu"> @endif
        <div class="col-md-12 form-group{{ $errors->has('asunto') ? ' has-error' : '' }}">
            <label class="control-label">Asunto *</label>
            <input class="form-control" type="text" name="asunto" value="{{old('asunto')}}">
            @if ($errors->has('asunto'))
                <span class="help-block">
                    <strong>{{ $errors->first('asunto') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-md-12 form-group {{ $errors->has('cuerpo') ? ' has-error' : '' }}">
            <label class="control-label">Mensaje *</label>
            <textarea class="form-control" name="cuerpo">{{old('cuerpo')}}</textarea>
            @if ($errors->has('cuerpo'))
                <span class="help-block">
                    <strong>{{ $errors->first('cuerpo') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group" >
            <div class="col-md-12{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                <label class="control-label">Captcha</label>
                    {!! \Recaptcha::render() !!}
            </div>
            <div class="clearfix"></div>
            <div class="col-md-6 bntEnviar"><input type="submit" class="btn btn-primary" value="Enviar Mensaje"></div>
        </div>


    </form>
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
