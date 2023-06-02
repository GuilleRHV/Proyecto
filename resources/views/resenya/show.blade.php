@extends('layouts.app')

{{-- Muestra los detalles de un resenya --}}

@section('content')
<div class="container contenedorcomentarios" style="" >
    <div class="row justify-content-center">
       
           


            @if($message = Session::get('respuesta'))
            <div class="alert alert-success">
                <h4>{{$message}}</h4>
            </div>
            @endif

            

            <hr>
            <div class="contenedorIndividual">



                <div class="text-center">
                    <h3 class="tituloresenyas">{{$resenya->titulo}}</h3>
                </div>
                <hr class="hr" />
                <div>





                </div>
                <div class="autor">Escrito por {{$resenya->nombreyapellido}}
                <p>Fecha publicacion: {{$resenya->created_at}}

                @if($resenya->created_at!=$resenya->updated_at)
                <p style="color:orange">EDITADO: {{$resenya->updated_at}}</p>
                @endif
                </p>
                
                </div>

                <div class="contenidoeimagen">


                    @if($resenya->imagen==null)
                    <div class="contenidoResenya">
                        <p style="overflow-wrap:break-word; width: 100%">{{$resenya->contenido}}</p>

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



            <h2>Comentarios</h2>

            @if(Auth::check())
            <form action="{{route('comentariosresenyas.store',['resenya_id'=>$resenya->id,'user_id'=>$user->id])}}" method="post">
                @csrf
                <div class="card card-white post">
                    <div class="post-heading">
                       
                        @if (auth()->user()->can('escribirComentariosResenya', $resenya)) 
                        <div class="form-group">
                            <label for="">Escribir un comentario</label>
                            <textarea class="form-control" rows="3" name="contenidocomentario"></textarea>
                        </div>


                     
                        <button type="submit" class="btn btn-success">Crear comentario <span class="fa fa-comments"></span>&nbsp;</button>
                        @else

                        <div class="alert alert-danger">
                            <h4>Para evitar el spam, solo puedes crear 6 comentarios por juego <br>(incluidas respuestas)</h4>
                        </div>
                        @endif
                    </div>

                </div>
            </form>
            <a href="{{route('proyects.index')}}" class="btn btn-warning" style="width: 100px !important; top:0 !important" >Home</a>
            @endif





            @if($comentariosresenya!=null && Auth::check())
            @foreach($comentariosresenya as $comentario)

            @if($comentario->padre_id==null)
            <form action="{{route('comentariosresenyas.responder',['resenya_id'=>$resenya->id,'user_id'=>$user->id,'comentario'=>$comentario])}}" method="post">
                @csrf
                <div class="card w-75">
                    <div class="card-body contenedorcomentarios" style="border-radius: 1em 1em 1em 1em">
                        <h5 class="card-title">
                        @if($comentario->usuario->imagen!=null)
                       
                           <img src="../{{$comentario->usuario->imagen}}" class="imagencomentario" />
                           @else
                           <img src="../imagenesperfil/userdefault.png" class="imagencomentario" />
                           @endif
                          {{$comentario->usuario->name}} </h5>
                   
                        
                        <h6>{{$comentario->updated_at}}</h6>
                        <p class="card-text textoajustado">{{$comentario->contenido}}</p>
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


            <button class="btn btn-danger esconder" id="esconder{{$comentario->id}}" onclick="escondercomentarios('padre{{$comentario->id}}',this.id)">Mostrar respuestas <span class="fa fa-sort-desc"></span>&nbsp;</button>
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
                        <p class="card-text textoajustado">{{$hijo->contenido}}</p>
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




                @if($comentariosresenya!=null && !Auth::check())
                @foreach($comentariosresenya as $comentario)

                @if($comentario->padre_id==null)
                <div class="card w-75">
                    <div class="card-body contenedorcomentarios" >
                        <h5 class="card-title">{{$comentario->usuario->name}}</h5>
                        <h6>{{$comentario->updated_at}}</h6>
                        <p class="card-text textoajustado">{{$comentario->contenido}}</p>
                    </div>
                </div>




                @if($comentario->hijos->isEmpty()==false)
                <h4>Respuestas</h4>


                <button class="btn btn-danger esconder" onclick="escondercomentarios('padre{{$comentario->id}}')">Esconder comentarios</button>

                @foreach($comentario->hijos as $hijo)

                <div class="card w-75 subcomentarios{{$hijo->padre_id}}" style="display:none">
                    <div class="card-body">
                        
                        <h5 class="card-title">{{ \App\Models\User::find($hijo->user_id)->name}}</h5>
                        <h6>{{$hijo->updated_at}}</h6>
                        <p class="card-text textoajustado">{{$hijo->contenido}}</p>
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