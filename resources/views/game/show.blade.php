@extends('layouts.app')

{{-- Muestra los detalles de un game --}}

@section('content')
<div class="container" style="background-color: white; border-radius: 20px 20px 20px 20px !important; border:2px solid grey">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($message = Session::get('comentarioeliminado'))
            <script>
                iziToast.success({
                    title: 'Operación exitosa',
                    message: '{{$message}}',
                });
            </script>
            @endif

            @if($message = Session::get('comentariocreado'))
            <script>
                iziToast.success({
                    title: 'Operación exitosa',
                    message: '{{$message}}',
                });
            </script>
            @endif
            @if($message = Session::get('respuesta'))
            <script>
                iziToast.success({
                    title: 'Operación exitosa',
                    message: '{{$message}}',
                });
            </script>
            @endif
            @if($message = Session::get('erroralcomentar'))
            <script>
                iziToast.warning({
                    title: 'Error',
                    message: '{{$message}}',
                });
            </script>
            @endif






            <h1 id="titulogameshow" class="titulojuegosyreseñas">{{ $game->nombre ?? '' }}</h1>

            <!--Imagen juego-->
            @if($game->imagen==null)
            <div id="contenedorimagenshow">
                <img src="../imagenes/filenotfound.png" id="imagenjuegoshow" class="imagenjuego">

                @else
                <img src="../{{$game->imagen}}" id="imagenjuegoshow" class="imagenjuego slide-in-bck-center" />
            </div>
            @endif



            <hr>
            <!--Nombre juego-->
            <div class="form-group">
                <label for="nombre" class="col-form-label" style="font-weight:600;font-size:17px">Nombre</label><br>
                <label for="nombre" class="col-form-label">{{ $game->nombre ?? '' }}</label>
            </div>
            <hr>
            <!--Descripcion juego-->
            <div class="form-group">
                <label for="descripcion" class="col-form-label" style="font-weight:600;font-size:17px">Descripción</label><br>
                <label for="descripcion" class="col-form-label">{{ $game->descripcion ?? '' }}</label>
            </div>
            <hr>
            <!--Año de lanzamiento-->
            <div class="form-group">
                <label for="anyoLanzamiento" class="col-form-label" style="font-weight:600;font-size:17px">Año de lanzamiento</label><br>
                <label for="anyoLanzamiento" class="col-form-label">{{ $game->anyoLanzamiento ?? '' }}</label>
            </div>
            <hr>
            <!--Generos juego-->
            <div class="row">
                <div class="form-group col-4">
                    <label for="generos" class="col-form-label" style="font-weight:600;font-size:17px">Generos</label><br>
                    @foreach($game->generos as $g)
                    <label for="generos" class="col-form-label">{{ $g ?? '' }}</label><br>
                    @endforeach

                </div>
                <!--Plataformas juego-->
                <div class="form-group col-4">
                    <label for="plataformas" class="col-form-label" style="font-weight:600;font-size:17px">Plataformas</label><br>
                    @foreach($game->plataformas as $p)
                    <label for="plataformas" class="col-form-label">{{ $p ?? '' }}</label><br>
                    @endforeach

                    <br>
                    <!--Boton ir al home-->

                </div>
                <!--Precio juego-->
                <div class="form-group">
                    <label for="precio" class="col-form-label" style="font-weight:600;font-size:17px">Precio</label><br>
                    <label for="precio" class="col-form-label">{{ $game->precio ?? '' }}</label>
                </div>
                <hr>

            </div>
            <div class="form-group ">
                <a href="{{route('proyects.index')}}" class="btn btn-primary">Home</a>


                @if(auth()->user()!=null)
                @if(auth()->user()->can('permisosAdmin',['App\Models\User',$user]))
                <!--Boton editar juego -->
                <a class="btn btn-warning" href="{{route('games.edit',$game->id)}}"><span class="fa fa-pencil"></span>&nbsp;</a>
                @endif
                @endif
            </div>
            <hr>







            <!-- COMENTARIOS-->
            <h2>Comentarios</h2>
            @if($errors->any())
            <div class="alert alert-danger">
                <h4>Por favor, corrige los siguientes errores:</h4>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}<br></li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(Auth::check())
            <form action="{{route('comentarios.store',['game_id'=>$game->id,'user_id'=>$user->id])}}" method="post">
                @csrf
                <div class="card card-white post">
                    <div class="post-heading">
                        @if(auth()->user()->can('escribirComentarios',['App\Models\Comentario',$game]))

                        <div class="form-group">
                            <label for="">Escribir un comentario</label>
                            <textarea class="form-control" rows="3" name="contenidocomentario"></textarea>
                        </div>



                        <button type="submit" class="btn btn-success">Crear comentario <span class="fa fa-comments"></span>&nbsp;</button>
                        @else
                        <!--Si has comentado 6 veces ya no te deja comentar más-->
                        
                        @endif
                    </div>

                </div>
            </form>

            @endif




            <!--Si existen comentarios y estas logeado-->
            @if($comentarios!=null && Auth::check())
            @foreach($comentarios as $comentario)

            @if($comentario->padre_id==null)
            <form action="{{route('comentarios.responder',['game_id'=>$game->id,'user_id'=>$user->id,'comentario'=>$comentario])}}" method="post">
                @csrf
                <div class="card w-75">
                    <div class="card-body contenedorcomentarios" style="border-radius: 1em 1em 1em 1em">
                        <h5 class="card-title">
                            <!--Imagen de perfil en el comentario-->
                            @if($comentario->usuario->imagen!=null)

                            <img src="../{{$comentario->usuario->imagen}}" class="imagencomentario" />
                            @else
                            <img src="../imagenesperfil/userdefault2.jpg" class="imagencomentario" />
                            @endif
                            <!--Nombre del usuario que ha comentado-->
                            {{$comentario->usuario->name}}
                        </h5>

                        <!--Fecha creacion de comentario-->
                        <h6>{{$comentario->created_at}}</h6>
                        <!--Contenido respuesta-->
                        <p class="card-text">{{$comentario->contenido}}</p>
                        <!--Responder a comentarios-->
                        @if (auth()->user()->can('escribirComentarios',['App\Models\Comentario',$game]))
                        <div class="form-group" style="background-color: rgb(207, 207, 207) !important; ">
                            <label for="" style="color:brown">Responder al comentario</label>
                            <textarea class="form-control" rows="2" name="contenidocomentario"></textarea>
                        </div>
                        <input type="submit" value="Responder" class="btn btn-warning">
                        @else
                       
                        @endif

            </form>
            @if(auth()->user()!=null)
            @if (auth()->user()->can('eliminarComentario', $comentario))
            <form action="{{route('comentarios.destroy',$comentario->id)}}" method="post" class="formularioeliminarcomentariojuego">
                @csrf
                @method('DELETE')
                <button type="submit" value="Eliminar" class="btn btn-danger"><span class="fa fa-trash"></span>&nbsp;</button>
            </form>
            @endif
            @endif

        </div>
    </div>







    <!--Si el comentario tiene respuestas-->
    @if($comentario->hijos->isEmpty()==false)

    <div class="form-group">
        <button class="btn btn-outline-danger esconder" id="esconder{{$comentario->id}}" onclick="escondercomentarios('padre{{$comentario->id}}',this.id)">Mostrar respuestas <span class="fa fa-sort-desc"></span>&nbsp;</button>
    </div>
    <span class="glyphicon glyphicon-chevron-down"></span>
    <span class="separadorDeHijos">
        <!--Recorre las respuestas-->
        @foreach($comentario->hijos as $hijo)

        <div class="card w-75 subcomentarios{{$hijo->padre_id}}" style="width: 600px !important; display:none">

            <div class="card-body">





                <!--Imagen perfil de quien ha respondido-->
                <h5>
                    @if(file_exists(\App\Models\User::find($hijo->user_id)->imagen))
                    <img src="../{{ \App\Models\User::find($hijo->user_id)->imagen}}" class="imagencomentario " />
                    @else
                    <img src="../imagenesperfil/userdefault2.jpg" class="imagencomentario" />
                    @endif
                    {{ \App\Models\User::find($hijo->user_id)->name}}
                </h5>


                <!--Fecha creacion respuesta-->
                <h6>{{$hijo->created_at}}</h6>
                <!--Contenido respuesta-->
                <p class="card-text">{{$hijo->contenido}}</p>
                @if(auth()->user()!=null)
                @if (auth()->user()->can('eliminarComentario', $hijo))

                <form action="{{route('comentarios.destroy',$hijo->id)}}" class="formularioeliminarrespuesta" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" value="Eliminar" class="btn btn-danger"><span class="fa fa-trash"></span>&nbsp;</button>
                </form>
                @endif
                @endif
            </div>
        </div>
        @endforeach
    </span>
    @endif



    <!--Fin subcomentario-->
    <hr>
    @endif



   
    @endforeach
    @endif


    <!--NO logeados -->




    @if($comentarios!=null && !Auth::check())
    @foreach($comentarios as $comentario)


    @if($comentario->padre_id==null)
    <div class="form-group">
        <div class="card w-75">
            <div class="card-body contenedorcomentarios" style="border-radius: 1em 1em 1em 1em">
                <h5 class="card-title">
                    <!--Imagen de perfil en el comentario-->
                    @if($comentario->usuario->imagen!=null)

                    <img src="../{{$comentario->usuario->imagen}}" class="imagencomentario" />
                    @else
                    <img src="../imagenesperfil/userdefault2.jpg" class="imagencomentario" />
                    @endif
                    <!--Nombre del usuario que ha comentado-->
                    {{$comentario->usuario->name}}
                </h5>

                <!--Fecha creacion de comentario-->
                <h6>{{$comentario->created_at}}</h6>
                <!--Contenido respuesta-->
                <p class="card-text">{{$comentario->contenido}}</p>
                @if(auth()->user()!=null)
                @if (auth()->user()->can('eliminarComentario', $comentario))
                <form action="{{route('comentarios.destroy',$comentario->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" value="Eliminar" class="btn btn-danger"><span class="fa fa-trash"></span>&nbsp;</button>
                </form>
                @endif
                @endif
            </div>
        </div>
    </div>




    @if($comentario->hijos->isEmpty()==false)


    <div class="form-group">
        <button class="btn btn-outline-danger esconder" id="esconder{{$comentario->id}}" onclick="escondercomentarios('padre{{$comentario->id}}',this.id)">Mostrar respuestas <span class="fa fa-sort-desc"></span>&nbsp;</button>
    </div>
    <!--Recorre las respuestas-->
    <span class="separadorDeHijos">
        @foreach($comentario->hijos as $hijo)

        <div class="card w-75 subcomentarios{{$hijo->padre_id}}" style="width: 600px !important; display:none">

            <div class="card-body">
                <h5 class="card-title">

                    <!--Imagen perfil de quien ha respondido-->
                    @if($comentario->usuario->imagen!=null)


                    <img src="../{{$comentario->usuario->imagen}}" class="imagencomentario" />
                    @else
                    <img src="../imagenesperfil/userdefault2.jpg" class="imagencomentario" />
                    @endif
                    {{ \App\Models\User::find($hijo->user_id)->name}}
                </h5>
                <!--Fecha creacion respuesta-->
                <h6>{{$hijo->created_at}}</h6>
                <!--Contenido respuesta-->
                <p class="card-text">{{$hijo->contenido}}</p>
                @if(auth()->user()!=null)
                @if (auth()->user()->can('eliminarComentario', $hijo))
                <form action="{{route('comentarios.destroy',$hijo->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" value="Eliminar" class="btn btn-danger"><span class="fa fa-trash"></span>&nbsp;</button>
                </form>
                @endif
                @endif
            </div>
        </div>
        @endforeach
    </span>
    @endif



    <!--Fin subcomentario-->
    <hr>
    @endif



    <br>
    @endforeach
    @endif
</div>
</div>
</div>
@endsection