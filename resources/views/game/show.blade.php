@extends('layouts.app')

{{-- Muestra los detalles de un game --}}

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>Detalle del game</h1>


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
                <label for="generos" class="col-form-label">{{ $g->generos ?? '' }}</label>
                @endforeach
                
            </div>
            

            <hr>

            </table>





        
            <a href="{{route('games.show',$game->id)}}" class="btn btn-warning">Editar</a>






        </div>
    </div>
</div>
@endsection