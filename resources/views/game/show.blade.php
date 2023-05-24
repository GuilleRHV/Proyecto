@extends('layouts.app')

{{-- Muestra los detalles de un game --}}

@section('content')
<div class="container" style="background-color: white; border-radius: 20px 20px 20px 20px !important; border:2px solid grey">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 id="titulogameshow">{{ $game->nombre ?? '' }}</h1>


            @if($game->imagen==null)
            <div id="contenedorimagenshow">
                <img src="../imagenes/filenotfound.png" id="imagenjuegoshow" class="imagenjuego">

                @else
                <img src="../{{$game->imagen}}" id="imagenjuegoshow" class="imagenjuego"/>
            </div>
            @endif


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
                <label for="generos" class="col-form-label">{{ $g ?? '' }}</label><br>
                @endforeach

            </div>

            <div class="form-group">
                <label for="plataformas" class="col-form-label" style="font-weight:600;font-size:17px">Plataformas</label><br>
                @foreach($game->plataformas as $p)
                <label for="plataformas" class="col-form-label">{{ $p ?? '' }}</label><br>
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
                        @if(auth()->user()->can('escribirComentarios',['App\Models\Comentario',$game]))

                        <div class="form-group">
                            <label for="">Escribir un comentario</label>
                            <textarea class="form-control" rows="3" name="contenidocomentario"></textarea>
                        </div>


                        <input type="submit" value="Crear comentario" class="btn btn-success">

                        @else

                        <div class="alert alert-danger">
                            <h4>Para evitar el spam, solo puedes crear 6 comentarios por juego <br>(incluidas respuestas)</h4>
                        </div>
                        @endif
                    </div>

                </div>
            </form>
            <a href="{{route('proyects.index')}}" class="btn btn-warning" style="width: 100px !important; top:0 !important">Home</a>
            @endif





            @if($comentarios!=null && Auth::check())
            @foreach($comentarios as $comentario)

            @if($comentario->padre_id==null)
            <form action="{{route('comentarios.responder',['game_id'=>$game->id,'user_id'=>$user->id,'comentario'=>$comentario])}}" method="post">
                @csrf
                <div class="card w-75">
                    <div class="card-body" style="background-color: grey; border-radius: 1em 1em 1em 1em">
                        <h5 class="card-title">
                        @if($comentario->usuario->imagen!=null)
                       
                           <img src="../{{$comentario->usuario->imagen}}" class="imagencomentario" />
                           @else
                           <img src="../imagenesperfil/userdefault.png" class="imagencomentario" />
                           @endif
                          {{$comentario->usuario->name}} </h5>
                   
                        
                        <h6>{{$comentario->updated_at}}</h6>
                        <p class="card-text">{{$comentario->contenido}}</p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Responder al comentario</label>
                    <textarea class="form-control" rows="2" name="contenidocomentario"></textarea>
                </div>

                <input type="submit" value="Responder" class="btn btn-warning">
            </form>
            @if($comentario->hijos->isEmpty()==false)
            <h4>Respuestas</h4>


            <button class="btn btn-danger esconder" id="esconder{{$comentario->id}}" onclick="escondercomentarios('padre{{$comentario->id}}',this.id)">Mostrar respuestas</button>
            <span class="glyphicon glyphicon-chevron-down"></span>
            <span class="glyphicon glyphicon-pencil">
                @foreach($comentario->hijos as $hijo)

                <div class="card w-75 subcomentarios{{$hijo->padre_id}}" style="width: 300px !important; display:none">
                    <div class="card-body">
                        <h5 class="card-title">
                        
                            @if($comentario->usuario->imagen!=null)
                            <h3>{{$hijo->user_id}}</h3>
                         
                            <img src="../{{$comentario->usuario->imagen}}" class="imagencomentario" />
                           @else
                           <img src="../imagenesperfil/userdefault.png" class="imagencomentario" />
                           @endif
                            {{ \App\Models\User::find($hijo->user_id)->name}}</h5>
                        <h6>{{$hijo->updated_at}}</h6>
                        <p class="card-text">{{$hijo->contenido}}</p>
                    </div>
                </div>
                @endforeach
                @endif



                <!--Fin subcomentario-->
                <hr>
                @endif



                <br>
                @endforeach
                @endif


                <!--NO logeados -->




                @if($comentarios!=null && !Auth::check())
                @foreach($comentarios as $comentario)

                @if($comentario->padre_id==null)
                <div class="card w-75">
                    <div class="card-body" style="background-color: grey; border-radius: 1em 1em 1em 1em">
                        <h5 class="card-title">{{$comentario->usuario->name}}</h5>
                        <h6>{{$comentario->updated_at}}</h6>
                        <p class="card-text">{{$comentario->contenido}}</p>
                    </div>
                </div>




                @if($comentario->hijos->isEmpty()==false)
                <h4>Respuestas</h4>


                <button class="btn btn-danger esconder" onclick="escondercomentarios('padre{{$comentario->id}}')">Esconder comentarios</button>

                @foreach($comentario->hijos as $hijo)

                <div class="card w-75 subcomentarios{{$hijo->padre_id}}" style="width: 300px !important; display:none">
                    <div class="card-body">
                        
                        <h5 class="card-title">{{ \App\Models\User::find($hijo->user_id)->name}}</h5>
                        <h6>{{$hijo->updated_at}}</h6>
                        <p class="card-text">{{$hijo->contenido}}</p>
                    </div>
                </div>
                @endforeach
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