@extends('layouts.app')

@section('content')



<div class="container">




  <div class="row justify-content-center" id="fondo2index">


<!--Alertas acciones -->
    <div class="col-md-8">
      @if($message = Session::get('juegocreado'))
      <div class="alert alert-success">
        <h4>{{$message}}</h4>
      </div>
      @endif
      @if($message = Session::get('juegomodificado'))
      <div class="alert alert-success">
        <h4>{{$message}}</h4>
      </div>
      @endif
      @if($message = Session::get('juegoeliminado'))
      <div class="alert alert-success">
        <h4>{{$message}}</h4>
      </div>
      @endif

      @if($message = Session::get('bibliotecavacia'))
      <div class="alert alert-info">
        <h4>{{$message}}</h4>
      </div>
      @endif

      @if($message = Session::get('usuarioeditado'))
      <div class="alert alert-info">
        <h4>{{$message}}</h4>
      </div>
      @endif

      @if($message = Session::get('contraseñaactualizada'))
      <div class="alert alert-info">
        <h4>{{$message}}</h4>
      </div>
      @endif


      @if($message = Session::get('coleccionvacia'))
      <div class="alert alert-info">
        <h4>{{$message}}</h4>
      </div>
      @endif
      @if($message = Session::get('agregadoacoleccion'))
      <div class="alert alert-success">
        <h4>{{$message}}</h4>
      </div>
      @endif


<!--Fin alertas acciones -->



<!--Panel videojuegps-->
      <h1 id="listavideojuegosh1"> Lista videojuegos</h1><br>
      @if($user!=null)
      @if(auth()->user()->can('permisosAdmin',['App\Models\User',$user]))

      <!--Crear videojuegos -->
      <a class="btn btn-success" href="{{ route('games.create') }}" class="btn btn pulsate-fwd">Añadir juego</a>
      @endif
      @endif

      <!--Ver reseñas -->
      <a class="btn btn-success" href="{{ route('resenyas.index') }}" class="btn btn pulsate-fwd">Ver reseñas</a>
      @if($user!=null)
      @if(auth()->user()->can('agregarABiblioteca',$user))
      <!--Ver mi biblioteca -->
      <a class="btn btn-warning" href="{{ route('users.verMiBiblioteca') }}" class="btn btn pulsate-fwd">Mi biblioteca</a>


      @endif
      <!--Ver votaciones -->
      <a class="btn btn-warning" href="{{ route('votacion.votacionesGeneral') }}" class="btn btn pulsate-fwd">Ver votaciones</a>
     
      <!--Ir a mi perfil -->
      <a class="btn btn-primary" href="{{ route('users.perfil') }}" class="btn btn"><span class="fa fa-user pulsate-fwd"></span>&nbsp;</a>

@endif


<!--Contenedor con todos los juegos creados -->
      <div id="contenedorGamesIndex">
        @foreach($gameList as $game)
        <!--Contenedor individual de juego-->
        <div class="contenedorGameIndividual">
          <!--Nombre juego-->
          <p class="contenedorGameIndividualNombre elipsis"><strong>{{$game->nombre}}</strong></p>
          <!--Anyo lanzamiento juego -->
          <p class="contenedorGameIndividualAnyoLanzamiento elipsis">{{$game->anyoLanzamiento}}</p>
          <!--Generos juegos-->
          <p class="contenedorGameIndividualGeneros ">@foreach($game->generos as $gen)
            {{$gen}}
            @endforeach
          </p>
          <!--Imagen juego -->
          <div class="contenedorGameIndividualImagen"> @if($game->imagen==null)
            <img src="imagenes/filenotfound.png" width="85px" height="85px" style="border-radius: 50% 50% 50% 50%;">

            @else
            <img src="{{$game->imagen}}" width="90px" height="90px" />

            @endif
            <a class="btn btn-warning" href="{{ route('games.show',$game->id) }}" class="btn btn"><span class="fa fa-eye"></span>&nbsp;</a>
            @if($user!=null)
            @if(auth()->user()->can('agregarABiblioteca',$user))

            <!--Boton agregar a coleccion/biblioteca -->
            <form action="{{ route('games.agregarAColeccion',['user'=>$user,'game'=>$game]) }}" method="post">
              @csrf
              <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span>&nbsp;</button>
            </form>


            @if(auth()->user()->can('permisosAdmin',['App\Models\User',$user]))
            <!--Boton ditar juego -->
            <a class="btn btn-warning" href="{{route('games.edit',$game->id)}}"><span class="fa fa-pencil"></span>&nbsp;</a>


            <!--Boton eliminar juego -->
            <form action="{{route('games.destroy',$game->id)}}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" value="Eliminar" class="btn btn-danger"><span class="fa fa-trash"></span>&nbsp;</button>
            </form>

            @endif
            @endif
            @endif
          </div>
        </div>
        <!--Fin contenedor individual juego -->
        @endforeach
      </div>
      <!--Fin contenedor general juegos -->







    </div>
  </div>
</div>






<?php
$contador = 1;

?>

<!--VOTACIONES-->
<div class="col-md-4">
  @if(auth()->user()!=null)
  <table class="table table-striped table-dark " style="display: flex;align-items:center" id="contenedorVotaciones">
    <tr>VOTACIONES</tr>
  <tr>
      <td>NOMBRE</td>
      <td>DESCRIPCION</td>

      <td></td>
    </tr>

    @foreach($votacionesList as $votacion)
    <tr>



    <!--Si la votacion está activa-->
      @if($votacion->participantes==null && $votacion->activo==1)

      <td>{{$votacion->nombre}}</td>
      <td>{{$votacion->descripcion}}</td>

      <!--Boton votar-->
      <td><button class="btn btn-info votaciones" onclick="votar(this.id)" href="{{route('votaciones.edit',$votacion->id)}}" id="votar{{$votacion->id}}">Votar</button></td>

      @endif



      @if($votacion->participantes!=null && $votacion->activo==1)
      @if(!in_array($user->id,json_decode($votacion->participantes))){

        <!--Si hay participantes-->
      <td>{{$votacion->nombre}}</td>
      <td>{{$votacion->descripcion}}</td>

      <td><button class="btn btn-info votaciones" onclick="votar(this.id)" href="{{route('votaciones.edit',$votacion->id)}}" id="votar{{$votacion->id}}">Votar</button></td>
      @endif
      @endif


    </tr>
    {{$contador++}}
    @endforeach



  </table>
  <!--Fin tabla votaciones-->
  @endif
</div>

@endsection





<!--NAVBAR PARA ADMINISTRADORES-->
@section('adminnavbar')

@if($user!=null)
@if(auth()->user()->can('permisosAdmin',['App\Models\User',$user]))
<nav class="navbar navbar-light bg-dark fixed-top" id="navbaradmin">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Herramientas de administrador</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#paneladministrador" aria-controls="paneladministrador">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="paneladministrador" aria-labelledby="navBarApagado">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="navBarApagado">Administrador</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
      </div>

      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <!--Boton gestionar usuarios-->
            <a class="nav-link active" aria-current="page" href="{{ route('users.index') }}">Usuarios</a>
          </li>
          <li class="nav-item">
            <!--Boton gestionar votaciones-->
            <a class="nav-link active" aria-current="page" href="{{ route('votaciones.index') }}">Votaciones</a>
          </li>

        </ul>

      </div>
    </div>
  </div>
</nav>

@endif
@endif

@endsection