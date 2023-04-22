@extends('layouts.app')

{{-- Muestra los detalles de un game --}}

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 id="titulogameshow">{{ $game->nombre ?? '' }}</h1>


            @if($game->imagen==null)
            <div id="contenedorimagenshow">
                <img src="../imagenes/filenotfound.png" id="imagenjuegoshow">

                @else
                <img src="../{{$game->imagen}}" id="imagenjuegoshow" />
            </div>
            @endif


            @if($message = Session::get('tratamientoeliminado'))
            <div class="alert alert-success">
                <h4>{{$message}}</h4>
            </div>
            @endif

            <hr>

            <div class="form-group">
                <label for="nombre" class="col-form-label" style="font-weight:600;font-size:17px">Nombre</label><br>
                <label for="nombre" class="col-form-label">{{ $game->nombre ?? '' }}</label>
            </div>
            <hr>
            <div class="form-group">
                <label for="descripcion" class="col-form-label" style="font-weight:600;font-size:17px">Apellidos</label><br>
                <label for="descripcion" class="col-form-label">{{ $game->descripcion ?? '' }}</label>
            </div>
            <hr>
            <div class="form-group">
                <label for="anyoLanzamiento" class="col-form-label" style="font-weight:600;font-size:17px">Año de lanzamiento</label><br>
                <label for="anyoLanzamiento" class="col-form-label">{{ $game->anyoLanzamiento ?? '' }}</label>
            </div>
            <hr>
            <div class="form-group">
                <label for="generos" class="col-form-label" style="font-weight:600;font-size:17px">Generos</label><br>
                @foreach($game->generos as $g)
                <label for="generos" class="col-form-label">{{ $g ?? '' }}</label><br>
                @endforeach

            </div>

            <div class="form-group">
                <label for="plataformas" class="col-form-label" style="font-weight:600;font-size:17px">Plataformas</label><br>
                @foreach($game->plataformas as $p)
                <label for="plataformas" class="col-form-label">{{ $p ?? '' }}</label><br>
                @endforeach

            </div>


            <hr>




            </table>

            









        </div>
    </div>
</div>
@endsection