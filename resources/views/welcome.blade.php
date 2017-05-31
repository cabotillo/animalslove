@extends('layouts.app')

@section('content')
    <div class="container">

        <!-- MODAL DE BIENVENIDA -->

        <div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <p></p>

                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            @if(!Auth::guest())

                @if(isset($mensaje))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ $mensaje }}
                    </div>
                @endif
                <p>{{Auth::user()->mascotas}}</p>
            @endif
        </div>
    </div>
@endsection
@section('scripts')

    <script type="text/javascript">
        $(document).ready(function(){
            $("#myModal").modal('show');
        });
    </script>

@endsection