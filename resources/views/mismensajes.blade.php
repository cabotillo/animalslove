@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($mensaje))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ $mensaje }}
        </div>
    @endif
    <div class="col-md-12"><h1>Tus Chats</h1><br></div>
    <div class="col-md-12">
        <ul>
        @foreach($chats as $c)
            <li>
                <a href="{{'mensajes/',$c->login}}{{$c->login}}">
                    <div class="chat">

                        <div class="col-md-2 hidden-xs">
                         <img class="img-responsive" src="storage/{{$c->avatar}}" alt="avatar">
                        </div>
                        <div class="col-md-2 hidden-xs"></div>
                        <div class="col-md-2">
                            <span>{{$c->login}}</span>
                        </div>
                        <div class="col-md-1 hidden-xs"></div>
                        <div class="col-md-3">
                            <span>{{strftime('%D a las %T', strtotime($c->updated_at))}}</span>
                        </div>
                    </div>
                </a>
            </li>
    @endforeach
        </ul>
    </div>
</div>
@endsection