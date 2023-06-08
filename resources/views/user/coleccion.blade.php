@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

    @if($message = Session::get('borradocoleccion'))
            <div class="alert alert-success">
                <h4>{{$message}}</h4>
            </div>
            @endif
      
<!--Solo puedes acceder a esta vista si tienes juegos en tu coleccion-->
      <h1 class="tituloprincipal">Coleccion de videojuegos</h1>
     

      <table class="table table-striped table-hover" style="display: flex;align-items:center;" id="contenedorGamesColeccion">
        <tr>
        <td>IMAGEN</td>
          <td>NOMBRE</td>

          <td>AÑO DE LANZAMIENTO</td>
          <td>GENEROS</td>

          <td>PRECIO</td>
          
        </tr>

        <!--Recorre tu coleccion juego por juego-->
        @foreach($gameList as $game)
        @if($game!=null)
        <tr>
        <td>
          <!--Imagen del juego, si no tiene se le asigna uno por defecto-->
            @if($game->imagen==null)
            <img src="../imagenes/filenotfound.png" width="200px" height="250px">

            @else
            <img src="../{{$game->imagen}}" width="200px" height="250px" />

            @endif
          </td>
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
          
         
          <!--Boton mostrar juego-->
          <td> <a class="btn btn jello-horizontal" href="{{ route('games.show',$game->id) }}" style="background-color: #9AD3E6"><span class="fa fa-eye"></span>&nbsp;</a></td>
          <!--Boton eliminar de mi biblioteca, se podrá volver a añadir desde el home-->
          <td> <a class="btn btn-danger jello-horizontal" href="{{ route('users.eliminarDeMiBiblioteca',['user'=>$user,'game'=>$game]) }}" class="btn btn"><span class="fa fa-trash"></span>&nbsp;</a></td>

        </tr>
        @endif
        @endforeach

      </table>


    </div>
  </div>
</div>
@endsection