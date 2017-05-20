@extends('layouts.app')

@section('content')
<div class="container">
    {{ csrf_field() }}
  <h1 >Chat con <span id="username">{{$login}}</span></h1>
    <div id="chat-window" class="col-lg-12"></div>
    <div class="col-lg-12">
        <div id="typingStatus" class="col-lg-12" style="padding: 15px"></div>
        <input type="text" id="text" class="form-control col-lg-12" autofocus="" onblur="notTyping()">
    </div>




</div>

@endsection

@section('scripts')
    <script src="../js/chats.js"></script>
<script>


</script>

@endsection