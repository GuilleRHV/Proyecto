@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!--Mensajes de alerta -->
           

            @if($message = Session::get('resenyaeliminada'))
            <script>
                iziToast.success({
                    title: 'Operación exitosa',
                    message: '{{$message}}',
                });
            </script>
            @endif
            @if($message = Session::get('resenyacreada'))
            <script>
                iziToast.success({
                    title: 'Operación exitosa',
                    message: '{{$message}}',
                });
            </script>
            @endif

            
            @if($message = Session::get('resenyamodificada'))
            <script>
                iziToast.info({
                    title: 'Edición exitosa',
                    message: '{{$message}}',
                });
            </script>
            @endif







<!--Si está logeado puede crear reseñas-->
<!--Boton para crear reseña-->
            @if(auth()->user()!=null)
            <a class="btn btn-success" href="{{ route('resenyas.create') }}" class="btn btn">crear reseñas</a>
            @endif
<!--Recorre las reseñas-->
            @foreach($resenyasList as $resenya)
<!--Contenedor individual para cada reseña-->
            <div class="contenedorIndividual">



                <div class="text-center">
                    <!--Titulo de la reseña -->
                    <h3 class="tituloresenyas">{{$resenya->titulo}}</h3>
                </div>
                <hr class="hr" />
                <!--Autor de la reseña -->
                <div class="autor">
                    Escrito por {{$resenya->nombreyapellido}}
                    <!--Fecha de publicacion de la reseña -->
                    <p>Fecha publicacion: {{$resenya->created_at}}
<!--Si la reseña se ha editado muestra que se ha modificado y cuando-->
                        @if($resenya->created_at!=$resenya->updated_at)
                    <p style="color:orange">EDITADO: {{$resenya->updated_at}}</p>
                    @endif
                    </p>

                </div>

                <!--Imagen de la reseña, si tiene una le reserva espacio, sino pues el texto de la reseña ocupa todo el campo-->
                <div class="contenidoeimagen">


                    @if($resenya->imagen==null)
                    <div class="contenidoResenya">
                        <p style="overflow-wrap:break-word; width: 100%">{{$resenya->contenido}}</p>
                        <p style="color: green" >Pros: </p>
                        <p style="overflow-wrap:break-word">{{$resenya->pros}} </p>
                        <p style="color: red">Contras: </p>
                        <p style="overflow-wrap:break-word">{{$resenya->contras}} </p>

                        <!--Muestra la calificacion de la reseña en iconos (estrellas)-->
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
                        <p style="color: green" >Pros: </p>
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
                    <div class="imagenResenya" >
                        <img src="{{asset($resenya->imagen)}}"  class="img-responsive"/>

                    </div>
                    @endif
                </div>
                @if(auth()->user()!=null)

              


                @if (auth()->user()->can('modificarResenya', $resenya))
                
                <!--Solo podrán modificar reseñas las personas que hayan escrito la misma (los administradores no podrán editarla)-->
                <!--Boton para modificar la reseña-->
                <a class="btn btn-warning" href="{{ route('resenyas.edit',$resenya->id) }}" class="btn btn"><span class="fa fa-pencil"></span>&nbsp;</a>


                @endif
                <!--Solo los los autores de las reseñas y los administradores podrán eliminar reseñas-->
                @if (auth()->user()->can('eliminarResenya', $resenya))

                <form action="{{route('resenyas.destroy',$resenya->id)}}" class="formularioeliminarresenya" method="post">
                    @csrf
                    @method('DELETE')
                    <!--Boton para eliminar la reseña-->
                    <button type="submit" value="X" class="btn btn-danger"><span class="fa fa-trash"></span>&nbsp;</button>
                </form>

                @endif
                @endif
                <!--Boton para mostrar detalles de la reseña seleccionada-->
                <a class="btn btn" href="{{ route('resenyas.show',$resenya->id) }}" style="background-color: #9AD3E6"><span class="fa fa-eye"></span>&nbsp;</a>
            </div>


            @endforeach




        </div>
    </div>
</div>









@endsection