@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10" id="tablashowvotacion">
            <h1>Detalle de la votacion</h1>
                    <div class="form-group">
                    <label for="nombre" class="col-form-label" style="font-weight:600;font-size:17px">Nombre</label><br>
                    <label for="nombre" class="col-form-label">{{ $votacion->nombre ?? '' }}</label>
                    </div>

                    <div class="form-group">
                    <label for="email" class="col-form-label" style="font-weight:600;font-size:17px">descripcion</label><br>
                    <label for="email" class="col-form-label">{{ $votacion->descripcion ?? '' }}</label>
                    </div>
                    <div class="form-group">
                    <label for="email" class="col-form-label" style="font-weight:600;font-size:17px">
                    {{ $votacion->nombreopcion1}}</label><br>
                    <label for="email" class="col-form-label">votos: {{ $votacion->valoropcion1  ?? '' }}</label>
                    </div>
                    <div class="form-group">
                    <label for="email" class="col-form-label" style="font-weight:600;font-size:17px">{{ $votacion->nombreopcion2}}</label><br>
                    <label for="email" class="col-form-label">votos: {{ $votacion->valoropcion2  ?? '' }}</label>
                    </div>

                    <div class="form-group">
                    <label for="rol" class="col-form-label" style="font-weight:600;font-size:17px">Numero de participantes</label><br>
                    <label for="rol" class="col-form-label">{{$numparticipantes}}</label>
                    </div>
                   
                        
                    
                    <a href="{{route('proyects.index')}}" class="btn btn-primary">Index</a>
        </div>
    </div>
</div>
@endsection