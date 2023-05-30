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

            



            @if(auth()->user()!=null)
            <a class="btn btn-success" href="{{ route('resenyas.create') }}" class="btn btn">crear reseñas</a>
            @endif
        
            @foreach($resenyasList as $resenya)

            <div class="contenedorIndividual">

                

                <div class="text-center">
                    <h3>{{$resenya->titulo}}</h3>
                </div>
                <hr class="hr" />
                <div>
                   




                </div>
                <div class="autor">Escrito por {{$resenya->nombreyapellido}}

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

            </div>
            @if (auth()->user()->can('modificarResenya', $resenya)) {
            
            <a class="btn btn-warning" href="{{ route('resenyas.create') }}" class="btn btn">Modificar reseña</a>


            <form action="{{route('resenyas.destroy',$resenya->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Eliminar reseña" class="btn btn-danger"/>
                        </form>
            
            @endif

            @endforeach




        </div>
    </div>
</div>









@endsection