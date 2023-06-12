@extends('layouts.app')

@section('content')
<style>
  #footer{
    position: sticky ;
    width: 100% !important;
    bottom: 0 !important;
}
</style>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      @if($message = Session::get('borradocoleccion'))
      <script>
        iziToast.success({
          title: 'Operación exitosa',
          message: '{{$message}}',
        });
      </script>
      @endif

      <!--Solo puedes acceder a esta vista si tienes juegos en tu coleccion-->
      <h1 class="tituloprincipal">Coleccion de videojuegos</h1>
    <!--Eliminar todos los juegos de tu coleccion-->
<form method="POST" action="{{ route('users.eliminarTodaBiblioteca',['user'=>$user])}}" class="formeliminartodacoleccion">
            @csrf
            @method("DELETE")
            <td>
              <button type="submit" class="btn btn-danger jello-horizontal" class="btn btn">Eliminar todos <span class="fa fa-trash"></span>&nbsp;</button>
            </td>
          </form>

      <table class="table table-striped table-hover" style="display: flex;align-items:center;" id="contenedorGamesColeccion">
        <tr>
          <td>IMAGEN</td>
          <td>NOMBRE</td>

          <td class="tdresp">AÑO DE LANZAMIENTO</td>
          <td class="tdresp">GENEROS</td>

          <td class="tdresp">PRECIO</td>
<td></td>
<td></td>
        </tr>

        <!--Recorre tu coleccion juego por juego-->
        @foreach($gameList as $game)
        @if($game!=null)
        <tr>
          <td>
            <!--Imagen del juego, si no tiene se le asigna uno por defecto-->
            @if($game->imagen==null)
            <img src="../imagenes/filenotfound.png"  width="150" height="150" class="img-responsive" >

            @else
            <img src="../{{$game->imagen}}" width="150px" height="150px"  class="img-responsive"  />

            @endif
          </td>
          <!--Nombre del juego-->
          <td>{{$game->nombre}}</td>
          <!--Año de lanzamiento del juego-->
          <td class="tdresp">{{$game->anyoLanzamiento}}</td>
          <!--Generos del juego-->
          <td class="tdresp">
            @foreach($game->generos as $gen)
            {{$gen}}
            @endforeach
          </td>
          <!--Precio del juego-->
          <td class="tdresp">{{$game->precio}} euros</td>


          <!--Boton mostrar juego-->
          <td> <a class="btn btn jello-horizontal" href="{{ route('games.show',$game->id) }}" style="background-color: #9AD3E6"><span class="fa fa-eye"></span>&nbsp;</a></td>
          <!--Boton eliminar de mi biblioteca, se podrá volver a añadir desde el home-->
          <form method="POST" action="{{ route('users.eliminarDeMiBiblioteca',['user'=>$user,'game'=>$game]) }}" class="formeliminarcoleccion">
            @csrf
            @method("DELETE")
            <td>
              <button type="submit" class="btn btn-danger jello-horizontal" class="btn btn"><span class="fa fa-trash"></span>&nbsp;</button>
            </td>
          </form>
          <td>

        </tr>
        @endif
        @endforeach

      </table>


    </div>
  </div>
</div>
@endsection