@extends('layouts.app')

{{-- Muestra los detalles de un game --}}

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>{{ $game->nombre ?? '' }}</h1>
            <h2>Imagen :  public/{{$game->imagen}}</h2>
          {{ __DIR__ }}
            <img src="public/imagenes/filenotfound.png" width="300px" height="370px">

            
            <img src="{{$game->imagen}}" width="300px" height="370px" />

            

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

            <h2>Comentarios</h2>

            @if(Auth::check())
            <form action="{{route('comentarios.store',['game_id'=>$game->id,'user_id'=>$user->id])}}" method="post">
                @csrf
                <div class="card card-white post">
                    <div class="post-heading">

                        <input type="text" name="contenidocomentario" id="">
                        <input type="submit" value="Crear comentario" class="btn btn-success">
                    </div>

                </div>
            </form>
            @endif





            @if($comentarios!=null)
            @foreach($comentarios as $c)
            <div class="card w-75">
                <div class="card-body">
                    <h5 class="card-title">{{$c->usuario->name}}</h5>
                    <h6>{{$c->updated_at}}</h6>
                    <p class="card-text">{{$c->contenido}}</p>
                </div>
            </div>
            <br>
            @endforeach
            @endif



            <a href="{{route('games.show',$game->id)}}" class="btn btn-warning">Editar</a>






        </div>
    </div>
</div>
@endsection