@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($mensaje))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ $mensaje }}
        </div>
    @endif
    <h1>Tus Chats</h1><br>

    <div class="col-md-12">
        @foreach($chats as $c)
            <div @if($c->leido == 0)class="noleido"@else class="leido">@endif
                <a href="{{'mensajes/',$c->login}}{{$c->login}}">
                    <div class="row chat">
                        <div class="col-md-2">
                         <img class="img-responsive" src="storage/{{$c->avatar}}" alt="">
                        </div>
                        <div class="col-md-10">
                            <span class="L text">{{$c->login}}</span><span class="C text">{{$c->message}}</span><span class="R text">{{$c->updated_at}}</span>

                        </div>
                    </div>
                </a>
            </div>
    @endforeach
    </div>
</div>
@endsection
@section('styles')
    <style>
        li{
            list-style-type: none;
        }
        .chat{
            width:100%;
            text-align:center;
            display:flex;justify-content:center;align-items:center;
            margin-bottom: 10px;
        }
        .L{
            float:left;
        }

        .R{
            float:right;
        }

        .C{
            margin:0 auto;
        }

        a div div span{
            font-size: x-large;
        }
        a:link{
            text-decoration: none;
        }
        .text{
            color: #636b6f;
        }
        @media(max-width: 1199px){
            .R{
              float: left;
            }
        }
        @media(max-width: 991px){
            .R{
                float: none;

            }
        }
    </style>

@endsection