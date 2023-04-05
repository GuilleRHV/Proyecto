@extends('layouts.app')

{{-- Muestra los detalles de un juegospc --}}

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>Detalle del videojuego de Pc</h1>


            @if($message = Session::get('tratamientoeliminado'))
            <div class="alert alert-success">
                <h4>{{$message}}</h4>
            </div>
            @endif


            @foreach($juegospc as $j)
            {{$j->nombre}}
            @endforeach
            <hr>

            <div class="form-group">
                <label for="nombre" class="col-form-label" style="font-weight:600;font-size:17px">Nombre</label><br>
                <label for="nombre" class="col-form-label">{{ $juegospc->nombre ?? '' }}</label>
            </div>
            <hr>
            <div class="form-group">
                <label for="descripcion" class="col-form-label" style="font-weight:600;font-size:17px">Apellidos</label><br>
                <label for="descripcion" class="col-form-label">{{ $juegospc->descripcion ?? '' }}</label>
            </div>
            <hr>
            <div class="form-group">
                <label for="anyoLanzamiento" class="col-form-label" style="font-weight:600;font-size:17px">Año de lanzamiento</label><br>
                <label for="anyoLanzamiento" class="col-form-label">{{ $juegospc->anyoLanzamiento ?? '' }}</label>
            </div>
            <hr>
           
            

            <hr>

            </table>





        
            <a href="{{route('proyects.index')}}" class="btn btn-warning">Editar</a>






        </div>
    </div>
</div>
@endsection