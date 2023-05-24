@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($message = Session::get('productocreado'))
            <div class="alert alert-success">
                <h4>{{$message}}</h4>
            </div>
            @endif

            




            <h1>Coleccion de videojuegos</h1>

      
          
            <table class="table table-striped table-hover" style="display: flex;align-items:center;" id="contenedorGames">
        <tr>
          <td>NOMBRE</td>
          <td>DESCRIPCION</td>
          <td>AÑO DE LANZAMIENTO</td>
          <td>GENEROS</td>
          <td>PLATAFORMAS</td>
          <td>PRECIO</td>
          <td>IMAGEN</td>
        </tr>
        @foreach($gameList as $game)
        @if($game!=null)
        <tr>

          <td>{{$game->nombre}}</td>
          <td>{{$game->descripcion}}</td>
          <td>{{$game->anyoLanzamiento}}</td>
          <td>
            @foreach($game->generos as $gen)
            {{$gen}}
            @endforeach
          </td>
          <td>
            @foreach($game->plataformas as $gen1)
            {{$gen1}}
            @endforeach
          </td>
          <td>{{$game->precio}} euros</td>
          <td>
            @if($game->imagen==null)
            <img src="../imagenes/filenotfound.png" width="200px" height="250px">

            @else
            <img src="../{{$game->imagen}}" />

            @endif
          </td>

          <td> <a class="btn btn-warning" href="{{ route('games.show',$game->id) }}" class="btn btn">Ver juego</a></td>
          <td> <a class="btn btn-danger" href="{{ route('users.eliminarDeMiBiblioteca',['user'=>$user,'game'=>$game]) }}" class="btn btn">Eliminar de mi lista</a></td>
          <i class="fa fa-star"></i>
        </tr>
        @endif
        @endforeach

      </table>


        </div>
    </div>
</div>
@endsection