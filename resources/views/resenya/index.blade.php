@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($message = Session::get('juegocreado'))
            <div class="alert alert-success">
                <h4>{{$message}}</h4>
            </div>
            @endif

            @if($message = Session::get('resenyaeliminada'))
            <div class="alert alert-success">
                <h4>{{$message}}</h4>
            </div>
            @endif
            @if($message = Session::get('resenyamodificada'))
            <div class="alert alert-info">
                <h4>{{$message}}</h4>
            </div>
            @endif








            @if(auth()->user()!=null)
            <a class="btn btn-success" href="{{ route('resenyas.create') }}" class="btn btn">crear reseñas</a>
            @endif

            @foreach($resenyasList as $resenya)

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
                @if(auth()->user()!=null)
                @if (auth()->user()->can('modificarResenya', $resenya))

                <a class="btn btn-warning" href="{{ route('resenyas.edit',$resenya->id) }}" class="btn btn">Modificar reseña</a>


                <form action="{{route('resenyas.destroy',$resenya->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" value="X" class="btn btn-danger"><span class="fa fa-trash"></span>&nbsp;</button>
                </form>

                @endif
                @endif
                <a class="btn btn-warning" href="{{ route('resenyas.show',$resenya->id) }}" class="btn btn"><span class="fa fa-eye"></span>&nbsp;</a>
            </div>


            @endforeach




        </div>
    </div>
</div>









@endsection