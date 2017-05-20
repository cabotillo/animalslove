@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Tus Chats</h1>

    <div class="col-md-12">

        @foreach($chats as $c)
            <div>

                <p><a href="mensajes/{{$c}}">{{$c}}</a></p>

            </div>
        @endforeach
    </div>

</div>

@endsection