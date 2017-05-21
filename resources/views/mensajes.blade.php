@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chat con {{$usuario}}</h1>
    <form method="post" action="{{'mensajes'}}">
        {{ csrf_field() }}
        <div class="col-lg-12" id="mensajes">
            @for($i = 0;$i < count($mensajes);$i++)
                @if($mensajes[$i]->send_username == $usuario)
                    @if($mensajes[$i]->leido == 0)
                        <p class="left">{{$mensajes[$i]->message}}</p>
                    @else<p class="left">{{$mensajes[$i]->message}}</p>@endif
                @else
                    @if($mensajes[$i]->leido == 0)
                        <p class="right">{{$mensajes[$i]->message}}  <span>&#10004;</span></p>
                    @else<p class="right">{{$mensajes[$i]->message}} <span>&#10004;&#10004;</span></p>@endif
                @endif
            @endfor
        </div>
        <input type="text" name="mensaje">
        <input type="hidden" value="{{$usuario}}" name="sender">
        <input type="submit" value="Enviar Mensaje">


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

    </style>
@endsection