@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10" id="tablashowvotacion">
            <h1>Detalle de la votacion</h1>
            <!--Nombre de la votacion -->
            <div class="form-group">
                <label for="nombre" class="col-form-label" style="font-weight:600;font-size:17px">Nombre</label><br>
                <label for="nombre" class="col-form-label">{{ $votacion->nombre ?? '' }}</label>
            </div>
            <!--Descripcion de la votacion -->
            <div class="form-group">
                <label for="email" class="col-form-label" style="font-weight:600;font-size:17px">Descripcion</label><br>
                <label for="email" class="col-form-label">{{ $votacion->descripcion ?? '' }}</label>
            </div>
            <!--Nombre de la opcion 1-->
            @if($votacion->valoropcion1>$votacion->valoropcion2)
            <div class="form-group">
                <label for="email" class="col-form-label" style="font-weight:600;font-size:17px;">
                    <p style="color: green">{{ $votacion->nombreopcion1}}</p>
                </label><br>
                <label for="email" class="col-form-label">votos: {{ $votacion->valoropcion1  ?? '' }}</label>
            </div>
            <!--Nombre de la opcion 2-->
            <div class="form-group">
                <label for="email" class="col-form-label" style="font-weight:600;font-size:17px; ">
                    <p style="color: red">{{ $votacion->nombreopcion2}}</p>
                </label><br>
                <label for="email" class="col-form-label">votos: {{ $votacion->valoropcion2  ?? '' }}</label>
            </div>
            @endif
            <!--Si la opcion1 tiene mas votos que la opcion2, la opcion 1 se mostrara de color verde y la opcion 2 se mostrara de color rojo-->
            @if($votacion->valoropcion1<$votacion->valoropcion2)
                <div class="form-group">
                    <!--Nombre opcion 1-->
                    <label for="email" class="col-form-label" style="font-weight:600;font-size:17px;">
                        <p style="color: red">{{ $votacion->nombreopcion1}}</p>
                    </label><br>
                    <!--Votos opcion 1-->
                    <label for="email" class="col-form-label">votos: {{ $votacion->valoropcion1  ?? '' }}</label>
                </div>
                <div class="form-group">
                    <!--Nombre opcion 2-->
                    <label for="email" class="col-form-label" style="font-weight:600;font-size:17px; ">
                        <p style="color: green">{{ $votacion->nombreopcion2}}</p>
                    </label><br>
                    <!--Votos opcion 2-->
                    <label for="email" class="col-form-label">votos: {{ $votacion->valoropcion2  ?? '' }}</label>
                </div>
                @endif
                <!--Si la opcion2 tiene mas votos que la opcion1, la opcion 2 se mostrara de color verde y la opcion 1 se mostrara de color rojo-->
                @if($votacion->valoropcion1==$votacion->valoropcion2)
                <div class="form-group">
                    <!--Nombre opcion 1-->
                    <label for="email" class="col-form-label" style="font-weight:600;font-size:17px;">
                        <p style="">{{ $votacion->nombreopcion1}}</p>
                    </label><br>
                    <!--Votos opcion 1-->
                    <label for="email" class="col-form-label">votos: {{ $votacion->valoropcion1  ?? '' }}</label>
                </div>
                <div class="form-group">
                    <!--Nombre opcion 2-->
                    <label for="email" class="col-form-label" style="font-weight:600;font-size:17px; ">
                        <p style="">{{ $votacion->nombreopcion2}}</p>
                    </label><br>
                    <!--Votos opcion 2-->
                    <label for="email" class="col-form-label">votos: {{ $votacion->valoropcion2  ?? '' }}</label>
                </div>
                @endif
                <!--Numero de participantes en la votacion -->
                <div class="form-group">
                    <label for="rol" class="col-form-label" style="font-weight:600;font-size:17px">Numero de participantes</label><br>
                    <label for="rol" class="col-form-label">{{$numparticipantes}}</label>
                </div>


                <!--Voton para ir al home-->
                <a href="{{route('votacion.votacionesGeneral')}}" class="btn btn-primary">Index votaciones</a>
        </div>
    </div>
</div>
@endsection