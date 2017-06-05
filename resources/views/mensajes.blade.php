@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($_GET['u']))
        @if($_GET['u'] == 1)
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Mensaje enviado!
            </div>
        @elseif($_GET['u'] == 2)
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                El mensaje no puede estar vacio!
            </div>
        @elseif($_GET['u'] == 0)
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Se ha producido un error. Vuelve a intentarlo más tarde
            </div>
        @endif
    @endif
    <h1>Chat con {{$usuario}}</h1>
    <form method="post" action="{{'mensajes'}}">
        {{ csrf_field() }}
        <div class="col-md-12" id="mensajes">
            @for($i = 0;$i < count($mensajes);$i++)
                @if($mensajes[$i]->send_username == $usuario)
                    @if($mensajes[$i]->leido == 0)
                        <p class="left">{{$mensajes[$i]->message}}</p>
                    @else<p class="left">{{$mensajes[$i]->message}}</p>@endif
                @else
                    @if($mensajes[$i]->leido == 0)
                        <p class="right">{{$mensajes[$i]->message}}  <span class="checkB">&#10004;</span></p>
                    @else<p class="right">{{$mensajes[$i]->message}} <span class="checkV">&#10004;&#10004;</span></p>@endif
                @endif
            @endfor
        </div>

        <div class=" col-md-12 input-group">
            <input name="mensaje" class="form-control" placeholder="Escribe el mensaje que le quieras enviar a {{$usuario}}. Intro para enviar." aria-describedby="basic-addon2">
            <span class="input-group-addon" id="basic-addon2"><input class="btn" type="submit" value="Enviar Mensaje"></span>
            <input type="hidden" value="{{$usuario}}" name="sender">
        </div>


    </form>
</div>

@endsection

@section('styles')

    <style>

        #mensajes{
            min-height: 50px;
        }
        .left{
            text-align: left;
        }
        .right{
            text-align: right;
        }

        .checkV{color: #2ab27b}
        .checkB{color: #2a88bd}

    </style>
@endsection