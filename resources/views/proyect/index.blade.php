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







      <h1>Proyecto index</h1>
      @if($user!=null)
      @if(auth()->user()->can('permisosAdmin',['App\Models\User',$user]))
      <a class="btn btn-success" href="{{ route('games.create') }}" class="btn btn">Nuevo juego</a>
      @endif
      @endif
      <a class="btn btn-warning" href="{{ route('games.indexPc') }}" class="btn btn">JUEGOS DE PC</a>

      <a class="btn btn-warning" href="#" class="btn btn" onclick="a()" id="ordenarpor">ordenar por nombre</a>
      @if($user!=null)
      @if(auth()->user()->can('agregarABiblioteca',$user))
      <a class="btn btn-warning" href="{{ route('users.verMiBiblioteca',$user) }}" class="btn btn">Mi biblioteca</a>
      @endif
      @endif

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
            <img src="imagenes/filenotfound.png" width="200px" height="250px">

            @else
            <img src="{{$game->imagen}}" />

            @endif
          </td>

          <td> <a class="btn btn-warning" href="{{ route('games.show',$game->id) }}" class="btn btn">Ver juego</a></td>
          @if($user!=null)
          @if(auth()->user()->can('agregarABiblioteca',$user))
          <td>
            <form action="{{ route('games.agregarAColeccion',['user'=>$user,'game'=>$game]) }}" method="post">
              @csrf
              <input type="submit" class="btn btn-success" value="+">
            </form>
          </td>

          @endif
          @endif
        </tr>
        @endforeach

      </table>


      



    </div>
  </div>
</div>







<div class="col-md-4">
<table class="table table-striped table-hover" style="display: flex;align-items:center;" id="contenedorGames">
        <tr>
          <td>NOMBRE</td>
          <td>DESCRIPCION</td>
          <td>opcion 1</td>
          <td>opcion 1</td>

        </tr>
        @foreach($votacionesList as $votacion)
        <tr>

          <td>{{$votacion->nombre}}</td>
          <td>{{$votacion->descripcion}}</td>
          <td>{{$votacion->nombreopcion1}}</td>
          <td>{{$votacion->nombreopcion2}}</td>
        </tr>
        @endforeach
      </table>
</div>

@endsection






@section('adminnavbar')
@if($user!=null)
@if(auth()->user()->can('permisosAdmin',['App\Models\User',$user]))
<nav class="navbar navbar-light bg-dark fixed-top" id="navbaradmin">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Herramientas de administrador</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Administrador</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>

      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('users.index') }}">Usuarios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('votaciones.index') }}">Votaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>

@endif
@endif
@endsection