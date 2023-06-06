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

            




            <h1 class="tituloprincipal" >Coleccion de videojuegos</h1>

      
          
            <table class="table table-striped table-hover" style="display: flex;align-items:center;" id="contenedorGamesColeccion">
        <tr>
          <td>NOMBRE</td>
         
          <td>AÑO DE LANZAMIENTO</td>
          <td>GENEROS</td>
          
          <td>PRECIO</td>
          <td>IMAGEN</td>
        </tr>
        @foreach($gameList as $game)
        @if($game!=null)
        <tr>

          <td>{{$game->nombre}}</td>
         
          <td>{{$game->anyoLanzamiento}}</td>
          <td>
            @foreach($game->generos as $gen)
            {{$gen}}
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

          <td> <a class="btn btn-warning" href="{{ route('games.show',$game->id) }}" class="btn btn"><span class="fa fa-eye"></span>&nbsp;</a></td>
          <td> <a class="btn btn-danger" href="{{ route('users.eliminarDeMiBiblioteca',['user'=>$user,'game'=>$game]) }}" class="btn btn"><span class="fa fa-trash"></span>&nbsp;</a></td>
       
        </tr>
        @endif
        @endforeach

      </table>


        </div>
    </div>
</div>
@endsection