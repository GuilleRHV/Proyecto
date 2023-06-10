@extends('layouts.app')

{{-- Muestra los detalles de un resenya --}}

@section('content')
<div class="container contenedorcomentarios" style="">
    <div class="row justify-content-center">



        <!--Mensajes de alerta-->
        @if($message = Session::get('respuesta'))
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
        @if($message = Session::get('comentarioeliminado'))
        <script>
            iziToast.success({
                title: 'Operación exitosa',
                message: '{{$message}}',
            });
        </script>
        @endif






        <hr>
        <!--Contenedor individual de la reseña-->
        <div class="contenedorIndividual">



            <div class="text-center">
                <!--Titulo de la reseña-->
                <h2 class="tituloresenyas titulojuegosyreseñas">{{$resenya->titulo}}</h2>
            </div>
            <hr class="hr" />
            <div>
                <!--Autor de la reseña-->
            </div>
            <div class="autor">Escrito por {{$resenya->nombreyapellido}}
                <!--Fecha de publicacion de la reseña-->
                <p>Fecha publicacion: {{$resenya->created_at}}

                    <!--Si la reseña se ha modificado lo muestra y tambien la fecha de edicion-->
                    @if($resenya->created_at!=$resenya->updated_at)
                <p style="color:orange">EDITADO: {{$resenya->updated_at}}</p>
                @endif
                </p>

            </div>
            <!--Contenido de la imagen (si la  reseña tiene una imagen le reserva sitio, sino pues el texto ocupa todo el espacio)-->
            <div class="contenidoeimagen">


                @if($resenya->imagen==null)
                <div class="contenidoResenya">
                    <!--Muestra la calificacion de la reseña en iconos (estrellas)-->
                    <p style="overflow-wrap:break-word; width: 100%">{{$resenya->contenido}}</p>
                    <p style="color: green">Pros: </p>
                    <p style="overflow-wrap:break-word">{{$resenya->pros}} </p>
                    <p style="color: red">Contras: </p>
                    <p style="overflow-wrap:break-word">{{$resenya->contras}} </p>
                    Calificación: @if($resenya->puntuacion==1)
                    <i class="fa fa-star fa-xxl"></i>
                    @endif
                    @if($resenya->puntuacion==2)
                    <i class="fa fa-star fa-xxl"></i><i class="fa fa-star fa-xxl"></i>
                    @endif
                    @if($resenya->puntuacion==3)
                    <i class="fa fa-star fa-xxl"></i><i class="fa fa-star fa-xxl"></i><i class="fa fa-star fa-xxl"></i>
                    @endif
                    @if($resenya->puntuacion==4)
                    <i class="fa fa-star fa-xxl"></i><i class="fa fa-star fa-xxl"></i><i class="fa fa-star fa-xxl"></i><i class="fa fa-star fa-xxl"></i>
                    @endif
                    @if($resenya->puntuacion==5)
                    <i class="fa fa-star fa-xxl"></i><i class="fa fa-star fa-xxl"></i><i class="fa fa-star fa-xxl"></i><i class="fa fa-star fa-xxl"></i><i class="fa fa-star fa-xxl"></i>
                    @endif
                </div>
                @else
                <div class="contenidoResenya" style="width: 60%;">
                    <p style="overflow-wrap:break-word">{{$resenya->contenido}} </p>
                    <p style="color: green">Pros: </p>
                    <p style="overflow-wrap:break-word">{{$resenya->pros}} </p>
                    <p style="color: red">Contras: </p>
                    <p style="overflow-wrap:break-word">{{$resenya->contras}} </p>
                    Calificación: @if($resenya->puntuacion==1)
                    <i class="fa fa-star fa-xxl"></i>
                    @endif
                    @if($resenya->puntuacion==2)
                    <i class="fa fa-star fa-xxl"></i><i class="fa fa-star fa-xxl"></i>
                    @endif
                    @if($resenya->puntuacion==3)
                    <i class="fa fa-star fa-xxl"></i><i class="fa fa-star fa-xxl"></i><i class="fa fa-star fa-xxl"></i>
                    @endif
                    @if($resenya->puntuacion==4)
                    <i class="fa fa-star fa-xxl"></i><i class="fa fa-star fa-xxl"></i><i class="fa fa-star fa-xxl"></i><i class="fa fa-star fa-xxl"></i>
                    @endif
                    @if($resenya->puntuacion==5)
                    <i class="fa fa-star fa-xxl"></i><i class="fa fa-star fa-xxl"></i><i class="fa fa-star fa-xxl"></i><i class="fa fa-star fa-xxl"></i><i class="fa fa-star fa-xxl"></i>
                    @endif
                </div>
                <div class="imagenResenya" style="width: 40%;">
                    <img src="{{asset($resenya->imagen)}}" width="100%" height="100%" />

                </div>
                @endif
            </div>


            <!--COMENTARIOS-->
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

            <!--Si eres un usuario logueado puedes comentar-->
            @if(Auth::check())
            <form action="{{route('comentariosresenyas.store',['resenya_id'=>$resenya->id,'user_id'=>$user->id])}}" method="post">
                @csrf
                <div class="card card-white post">
                    <div class="post-heading">
                        @if(auth()->user()!=null)
                        @if (auth()->user()->can('escribirComentariosResenya', $resenya))
                        <div class="form-group">
                            <label for="">Escribir un comentario</label>
                            <!--Contenido para escribir el comentario -->
                            <textarea class="form-control" rows="3" name="contenidocomentario"></textarea>
                        </div>


                        <!--Boton para crear el comentario -->
                        <button type="submit" class="btn btn-success">Crear comentario <span class="fa fa-comments"></span>&nbsp;</button>
                        @else
                        <!--Si alcanzas los 6 comentarios te avisa e impide que puedas seguir comentando-->
                        <script>
                            iziToast.warning({
                                title: 'No puedes crear más comentarios',
                                message: 'Para evitar el spam, se limitan los comentarios por reseña a 6.',
                            });
                        </script>
                        @endif
                        @endif
            </form>
            <!--Boton para ir al indice de reseñas-->
            <a href="{{route('resenyas.index')}}" class="btn btn-warning" style="width: 100px !important; top:0 !important">Indice de reseñas</a>
        </div>

    </div>


    @endif




    <!--Si los comentarios no son nulos y estas autenticado-->
    @if($comentariosresenya!=null && Auth::check())
    <!--Recorre los comentarios-->
    @foreach($comentariosresenya as $comentario)

    <!--Si es comentario base (no es una respuesta a otro comentario)-->
    @if($comentario->padre_id==null)

    <div class="card w-75">
        <div class="card-body contenedorcomentarios" style="border-radius: 1em 1em 1em 1em">
            @if($comentario->usuario->imagen!=null)
            <!--Imagen de usuario del comentario-->
            <img src="../{{$comentario->usuario->imagen}}" class="imagencomentario" />
            @else
            <img src="../imagenesperfil/userdefault2.jpg" class="imagencomentario" />
            @endif


            <!--Nombre del usuario del comentario-->
            {{$comentario->usuario->name}}


            <!--Fecha de creacion del comentario-->
            <h6>{{$comentario->created_at}}</h6>
            <!--Contenido del comentario-->
            <p class="card-text textoajustado">{{$comentario->contenido}}</p>
            <div class="form-group" style="background-color: rgb(207, 207, 207) !important; ">

            @if (auth()->user()->can('escribirComentariosResenya',['App\Models\ComentarioResenya',$resenya]))
                <form action="{{route('comentariosresenyas.responder',['resenya_id'=>$resenya->id,'user_id'=>$user->id,'comentario'=>$comentario])}}" method="post">
                    @csrf
                    <!--Responder a un comentario-->
                    <label for="" style="color:brown">Responder al comentario</label>
                    <!--Texto para responder-->
                    <textarea class="form-control" rows="2" name="contenidocomentario"></textarea>
            </div>
            <!--Boton para responder a un comentario-->
            <input type="submit" value="Responder" class="btn btn-warning">

            @endif


            </form>
            @if(auth()->user()!=null)
            @if (auth()->user()->can('eliminarComentariosResenyas', $comentario))

            <form action="{{route('comentariosresenyas.destroy',$comentario->id)}}" method="post" class="formularioeliminarcomentarioresenya">
                @csrf
                @method('DELETE')
                <button type="submit" value="Eliminar" class="btn btn-danger"><span class="fa fa-trash"></span>&nbsp;</button>
            </form>
            @endif
            @endif
        </div>
    </div>

    <!--Si el comentario tiene hijos (respuestas)-->
    @if($comentario->hijos->isEmpty()==false)
    <h4>Respuestas</h4>

    <!--Mostrar / esconder respuestas-->
    <div class="form-group">
    <button class="btn btn-outline-danger esconder" id="esconder{{$comentario->id}}" onclick="escondercomentarios('padre{{$comentario->id}}',this.id)">Mostrar respuestas <span class="fa fa-sort-desc"></span>&nbsp;</button>
    </div>
    <span class="glyphicon glyphicon-chevron-down"></span>
    <span class="glyphicon glyphicon-pencil">
        @foreach($comentario->hijos as $hijo)
        <!--Recorre las respuestas-->
        <div class="card w-75 subcomentarios{{$hijo->padre_id}}" style="width: 600px !important; display:none">
            <div class="card-body">


                <!--Imagen perfil de quien ha respondido-->
                @if(file_exists(\App\Models\User::find($hijo->user_id)->imagen))
                <img src="../{{ \App\Models\User::find($hijo->user_id)->imagen}}" class="imagencomentario" />
                @else
                <img src="../imagenesperfil/userdefault2.jpg" class="imagencomentario" />
                @endif
                <!--Nombre del perfil de la respuesta-->
                {{ \App\Models\User::find($hijo->user_id)->name}}

                <!--Fecha de creacion de la respuesta -->
                <h6>{{$hijo->created_at}}</h6>
                <!--Contenido de la respuesta -->
                <p class="card-text textoajustado">{{$hijo->contenido}}</p>
                @if(auth()->user()!=null)
                @if (auth()->user()->can('eliminarComentariosResenyas', $hijo))
                <form action="{{route('comentariosresenyas.destroy',$hijo->id)}}" class="formularioeliminarrespuesta" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" value="Eliminar" class="btn btn-danger"><span class="fa fa-trash"></span>&nbsp;</button>
                </form>
                @endif
                @endif
            </div>
        </div>
        @endforeach
        @endif



        <!--Fin subcomentario-->
        <hr>
        @endif




        @endforeach
        @endif


        <!--NO LOGEADOS -->




        @if($comentariosresenya!=null && !Auth::check())
        @foreach($comentariosresenya as $comentario)

        @if($comentario->padre_id==null)
        <div class="card w-75">
            <div class="card-body contenedorcomentarios">
                <!--Nombre del autor del comentario-->
                <h5 class="card-title">{{$comentario->usuario->name}}</h5>
                <!--Fecha de creacion del comentario -->
                <h6>{{$comentario->created_at}}</h6>
                <!--Contenido del comentario -->
                <p class="card-text textoajustado">{{$comentario->contenido}}</p>

                <form action="{{route('comentarios.destroy',$hijo->id)}}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" value="Eliminar" class="btn btn-danger"><span class="fa fa-trash"></span>&nbsp;</button>
                </form>
            </div>
        </div>




        @if($comentario->hijos->isEmpty()==false)
        <h4>Respuestas</h4>

        <!--Boton para mostrar/esconder respuestas-->

        <button class="btn btn-outline-danger esconder" id="esconder{{$comentario->id}}" onclick="escondercomentarios('padre{{$comentario->id}}',this.id)">Mostrar respuestas <span class="fa fa-sort-desc"></span>&nbsp;</button>
        <!--Recorre los hijos(respuestas) de un comentario-->
        @foreach($comentario->hijos as $hijo)

        <div class="card w-75 subcomentarios{{$hijo->padre_id}}" style="display:none; width: 600px">
            <div class="card-body">
                <!--Nombre del autor de la respuesta-->
                <h5 class="card-title">{{ \App\Models\User::find($hijo->user_id)->name}}</h5>
                <!--Fecha de creacion de la respuesta-->
                <h6>{{$hijo->created_at}}</h6>
                <!--Contenido de la respuesta-->
                <p class="card-text textoajustado">{{$hijo->contenido}}</p>

                <form action="{{route('comentarios.destroy',$hijo->id)}}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" value="Eliminar" class="btn btn-danger"><span class="fa fa-trash"></span>&nbsp;</button>
                </form>
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