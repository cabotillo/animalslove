@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row col-md-8 col-md-offset-2">

        <h1>Formulario de contacto</h1>
                <form role="form" action="{{route('contacto')}}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('invi') ? ' has-error' : '' }}">
                        <label class="control-label">¿Tiene una cuenta en la web?</label>
                        <input type="radio" name="invi" value="si">Si
                        <input type="radio" name="invi" value="no" checked="checked">No
                        </select>
                        @if ($errors->has('invi'))
                            <span class="help-block">
                                <strong>{{ $errors->first('invi') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="nombre form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                        <label class="control-label">Nombre *</label>
                        <input class="form-control" type="text" name="nombre">
                        @if ($errors->has('nombre'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="login form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                        <label class="control-label">Nombre de usuario *</label>
                        <input class="form-control" type="text" name="login">
                        @if ($errors->has('login'))
                            <span class="help-block">
                                <strong>{{ $errors->first('login') }}</strong>
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
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-primary" value="Enviar Mensaje">
                    </div>
                </form>
            </div>
        </div>
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
