@extends('layouts.app')

@section('content')


<?php
$contador = 1;
?>



<link rel="stylesheet" href="{{asset('css/carousel.css')}}">

<!--VOTACIONES-->



<div class="row justify-content-center">


  @section("votaciones")

  @if(auth()->user()!=null)


  <table class="table table-striped table-dark " id="contenedorVotaciones">

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
      <td style="max-width: 250px !important; overflow-wrap:break-word !important;">{{$votacion->descripcion}}</td>

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



  <!--Fin condicion si no hay votaciones activas-->
  @endif
  @endsection
  <div class="col-md-10">





    <div class="container">
      <div id="wrap" style="position: relative;color: black !important; text-decoration:none !important">
        <a href="{{ route('games.show',11) }}" class="hb">
          <div class="c">
            <img src="{{asset('imagenescarousel/silksong.jpeg')}}" class="imagencarousel img-responsive" alt="" />
            <div class="txt">
              <h1 class="negro">Silksong</h1>
              <p class="negro">Esperada secuela del posiblemente mejor metroidvania de la historiacd</p>
            </div>
          </div>
        </a>

        <a href="#" class="hb">
          <div class="c">
            <img src="{{asset('imagenescarousel/ffvii.jpeg')}}" class="imagencarousel img-responsive" alt="" />
            <div class="txt">
              <h1 class="negro">Final Fantasy 7</h1>
              <p class="negro">Ponte en los pies de Cloud Strife y unete a Avalancha</p>
            </div>
          </div>
        </a>

        <a href="#" class="hb">
          <div class="c">
            <img src="{{asset('imagenescarousel/yakuza0.jpeg')}}" class="imagencarousel img-responsive" alt="" />
            <div class="txt">
              <h1 class="negro">Yakuza 0</h1>
              <p class="negro">Juego de yakuzas protagonizado por Kiryu Kazuma y Goro Majima</p>
            </div>
          </div>
        </a>

        <a href="#" class="hb">
          <div class="c">
            <img src="{{asset('imagenescarousel/sekiro.jpg')}}" class="imagencarousel img-responsive" alt="" />
            <div class="txt">
              <h1 class="negro">Sekiro</h1>
              <p class="negro">Tomas el papel de un shinobi que busca rescatar a su joven señor</p>
            </div>
          </div>
        </a>

        <a href="#" class="hb">
          <div class="c">
            <img src="{{asset('imagenescarousel/sekiro.jpg')}}" class="imagencarousel img-responsive" alt="" />
            <div class="txt">
              <h1 class="negro">Sekiro</h1>
              <p class="negro">Tomas el papel de un shinobi que busca rescatar a su joven señor</p>
            </div>
          </div>
        </a>

      </div>
      <br>


      <div class="row justify-content-center" id="fondo2index" style="z-index: 12;">


        <!--Alertas acciones -->
        <div class="col-md-10">
          @if($message = Session::get('juegocreado'))


          <script>
            iziToast.success({
              title: 'Operación exitosa',
              message: '{{$message}}',
            });
          </script>

          @endif
          @if($message = Session::get('juegomodificado'))
          <script>
            iziToast.success({
              title: 'Operación exitosa',
              message: '{{$message}}',
            });
          </script>
          @endif
          @if($message = Session::get('juegoeliminado'))
          <script>
            iziToast.success({
              title: 'Operación exitosa',
              message: '{{$message}}',
            });
          </script>
          @endif

          @if($message = Session::get('coleccionvacia'))
          <script>
            iziToast.info({
              title: 'Vaya...',
              message: '{{$message}}',
            });
          </script>
          @endif

          @if($message = Session::get('borradocoleccion'))
          <script>
            iziToast.success({
              title: 'Operación exitosa',
              message: '{{$message}}',
            });
          </script>
          @endif





          @if($message = Session::get('usuarioeditado'))
          <script>
            iziToast.info({
              title: 'Edición exitosa',
              message: '{{$message}}',
            });
          </script>
          @endif

          @if($message = Session::get('contraseñaactualizada'))
          <script>
            iziToast.info({
              title: 'Edición exitosa',
              message: '{{$message}}',
            });
          </script>
          @endif
          @if($message = Session::get('nohayvotaciones'))
          <script>
            iziToast.warning({
              title: 'Error',
              message: '{{$message}}',
            });
          </script>
          @endif



          @if($message = Session::get('agregadoacoleccion'))
          <script>
            iziToast.success({
              title: 'Operación exitosa',
              message: '{{$message}}',
            });
          </script>
          @endif


          <!--Fin alertas acciones -->




          <!--Panel videojuegps-->
          <h1 id="listavideojuegosh1" style="display: none;"> Lista videojuegos</h1><br>
          @if($user!=null)
          @if(auth()->user()->can('permisosAdmin',['App\Models\User',$user]))

          <!--Crear videojuegos -->
          <a class="btn btn-success pulsate-fwd" href="{{ route('games.create') }}" class="btn btn pulsate-fwd">Añadir juego</a>
          @endif
          @endif

          <!--Ver reseñas -->
          <a class="btn btn-success pulsate-fwd" href="{{ route('resenyas.index') }}">Ver reseñas</a>
          @if($user!=null)
          @if(auth()->user()->can('agregarABiblioteca',$user))
          <!--Ver mi biblioteca -->
          <a class="btn btn-warning pulsate-fwd" href="{{ route('users.verMiBiblioteca') }}" class="btn btn pulsate-fwd">Mi biblioteca</a>


          @endif
          <!--Ver votaciones -->
          <a class="btn btn pulsate-fwd" href="{{ route('votacion.votacionesGeneral') }}" class="btn btn pulsate-fwd" style="background-color: pink;">Ver votaciones</a>

          <!--Ir a mi perfil -->
          <a class="btn btn-primary pulsate-fwd" href="{{ route('users.perfil') }}" class="btn btn"><span class="fa fa-user pulsate-fwd"></span>&nbsp;</a>

          @endif

          
          <form action="{{ route('buscar') }}" method="GET">

        <div id="camposearcher">
          <button type="submit" class="btn btn-primary" style="float: right;"><span class="fa fa-search pulsate-fwd" id="botonsearcher"></span>&nbsp;Buscar</button>
            <input type="text" class="bordesredondeados" name="query" placeholder="Buscar juego" style="float: right;" id="searcher">
        </div>
       
          </form>
          <br>
          @if($query!=null)
          <p style="color:white">Resultados para: {{ $query }}</p>
          @endif
          @if($resultados!=null)
          @foreach ($resultados as $resultado)

          <div id="buscador">

            @if($resultado->nombre==$query)

            <div class="contenedorGameIndividual" style="background-color: #A3F6FF;">
              <!--Nombre juego-->
              <p class="contenedorGameIndividualNombre elipsis"><strong>{{$resultado->nombre}}</strong></p>
              <!--Anyo lanzamiento juego -->
              <p class="contenedorGameIndividualAnyoLanzamiento elipsis">{{$resultado->anyoLanzamiento}}</p>
              <!--Generos juegos-->
              <p class="contenedorGameIndividualGeneros ">@foreach($resultado->generos as $gen)
                {{$gen}}
                @endforeach
              </p>
              <!--Imagen juego -->
              <div class="contenedorGameIndividualImagen"> @if($resultado->imagen==null)
                <img src="imagenes/filenotfound.png" width="85px" height="85px" style="border-radius: 50% 50% 50% 50%;">

                @else
                <img src="{{$game->imagen}}" width="90px" height="90px" />

                @endif
                <a class="btn btn jello-horizontal" href="{{ route('games.show',$resultado->id) }}" style="background-color: #9AD3E6"><span class="fa fa-eye jello-horizontal"></span>&nbsp;</a>
                @if($user!=null)
                @if(auth()->user()->can('agregarABiblioteca',$user))

                <!--Boton agregar a coleccion/biblioteca -->
                <form action="{{ route('games.agregarAColeccion',['user'=>$user,'game'=>$resultado]) }}" method="post">
                  @csrf
                  <button type="submit" class="btn btn-success jello-horizontal"><span class="fa fa-plus-circle jello-horizontal"></span>&nbsp;</button>
                </form>


                @if(auth()->user()->can('permisosAdmin',['App\Models\User',$user]))
                <!--Boton ditar juego -->
                <a class="btn btn jello-horizontal" href="{{route('games.edit',$resultado->id)}}" style="background-color: #FEB895"><span class="fa fa-pencil jello-horizontal"></span>&nbsp;</a>


                <!--Boton eliminar juego -->
                <form action="{{route('games.destroy',$resultado->id)}}" method="post" class="formularioeliminarjuego">
                  @csrf
                  @method('DELETE')
                  <button type="submit" value="Eliminar" class="btn btn-danger jello-horizontal"><span class="fa fa-trash jello-horizontal"></span>&nbsp;</button>

                </form>


                @endif
                @endif
                @endif
              </div>
            </div>
            @endif
          </div>
          @endforeach
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
                <a class="btn btn jello-horizontal" href="{{ route('games.show',$game->id) }}" style="background-color: #9AD3E6"><span class="fa fa-eye jello-horizontal"></span>&nbsp;</a>
                @if($user!=null)
                @if(auth()->user()->can('agregarABiblioteca',$user))

                <!--Boton agregar a coleccion/biblioteca -->
                <form action="{{ route('games.agregarAColeccion',['user'=>$user,'game'=>$game]) }}" method="post">
                  @csrf
                  <button type="submit" class="btn btn-success jello-horizontal"><span class="fa fa-plus-circle jello-horizontal"></span>&nbsp;</button>
                </form>


                @if(auth()->user()->can('permisosAdmin',['App\Models\User',$user]))
                <!--Boton ditar juego -->
                <a class="btn btn jello-horizontal" href="{{route('games.edit',$game->id)}}" style="background-color: #FEB895"><span class="fa fa-pencil jello-horizontal"></span>&nbsp;</a>


                <!--Boton eliminar juego -->
                <form action="{{route('games.destroy',$game->id)}}" method="post" class="formularioeliminarjuego">
                  @csrf
                  @method('DELETE')
                  <button type="submit" value="Eliminar" class="btn btn-danger jello-horizontal"><span class="fa fa-trash jello-horizontal"></span>&nbsp;</button>

                </form>


                @endif
                @endif
                @endif
              </div>
            </div>
            <!--Fin contenedor individual juego -->
            @endforeach
            <br>
            <div id="" style="margin: auto !important">
              {{$gameList->links('pagination::bootstrap-4')}}
            </div>


          </div>
          <!--Fin contenedor general juegos -->







        </div>
      </div>
    </div>








    @endsection





    <!--NAVBAR PARA ADMINISTRADORES-->
    @section('adminnavbar')

    @if($user!=null)
    @if(auth()->user()->can('permisosAdmin',['App\Models\User',$user]))
    <nav class="navbar navbar-light bg-dark fixed-top " id="navbaradmin">
      <div class="container-fluid">
        <a class="navbar-brand slide-in-elliptic-top-fwd" href="#">Herramientas de administrador</a>
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





    @section('js')
  </div>

  @endsection
















  @section("votaciones")

  @if(auth()->user()!=null)


  <table class="table table-striped table-dark " id="contenedorVotaciones">

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
      <td style="max-width: 250px !important; overflow-wrap:break-word !important;">{{$votacion->descripcion}}</td>

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



  <!--Fin condicion si no hay votaciones activas-->
  @endif
  @endsection