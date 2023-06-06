@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">


<!--Solo puedes acceder a esta vista si tienes juegos en tu coleccion-->
      <h1 class="tituloprincipal">Coleccion de videojuegos</h1>



      <table class="table table-striped table-hover" style="display: flex;align-items:center;" id="contenedorGamesColeccion">
        <tr>
          <td>NOMBRE</td>

          <td>AÑO DE LANZAMIENTO</td>
          <td>GENEROS</td>

          <td>PRECIO</td>
          <td>IMAGEN</td>
        </tr>

        <!--Recorre tu coleccion juego por juego-->
        @foreach($gameList as $game)
        @if($game!=null)
        <tr>
          <!--Nombre del juego-->
          <td>{{$game->nombre}}</td>
          <!--Año de lanzamiento del juego-->
          <td>{{$game->anyoLanzamiento}}</td>
          <!--Generos del juego-->
          <td>
            @foreach($game->generos as $gen)
            {{$gen}}
            @endforeach
          </td>
          <!--Precio del juego-->
          <td>{{$game->precio}} euros</td>
          <!--Imagen del juego, si no tiene se le asigna uno por defecto-->
          <td>
            @if($game->imagen==null)
            <img src="../imagenes/filenotfound.png" width="200px" height="250px">

            @else
            <img src="../{{$game->imagen}}" />

            @endif
          </td>
          <!--Boton mostrar juego-->
          <td> <a class="btn btn-warning" href="{{ route('games.show',$game->id) }}" class="btn btn"><span class="fa fa-eye"></span>&nbsp;</a></td>
          <!--Boton eliminar de mi biblioteca, se podrá volver a añadir desde el home-->
          <td> <a class="btn btn-danger" href="{{ route('users.eliminarDeMiBiblioteca',['user'=>$user,'game'=>$game]) }}" class="btn btn"><span class="fa fa-trash"></span>&nbsp;</a></td>

        </tr>
        @endif
        @endforeach

      </table>


    </div>
  </div>
</div>
@endsection