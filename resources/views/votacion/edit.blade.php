@extends('layouts.app')

@section('content')
<div class="container" style="background-color: white;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!--Esta vista es para hacer la votación, solo podras acceder 1 vez si completas el formulario-->

            <!--Nombre de la votacion-->
            <h1>{{ $votacion->nombre ?? '' }}</h1>
            <!--Descripcion de la votacion -->
            <h4>{{ $votacion->descripcion ?? '' }}</h4>


            <hr>
            <!--Errores del formulario-->
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

            <!--Formulario que hace la votacion-->
            <form action="{{route('votaciones.update',$votacion->id)}}" method="post" id="votacionedit">
                @csrf

                @method("PUT")






                <!--Check para la opcion 1-->
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="valorvotacion" id="flexRadioDefault1" value="nombreopcion1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        {{ $votacion->nombreopcion1 ?? '' }}
                    </label>
                </div>
                <!--Check para la opcion 2-->
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="valorvotacion" id="flexRadioDefault2" value="nombreopcion2" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        {{ $votacion->nombreopcion2 ?? '' }}
                    </label>
                </div>


        </div>


        <!--Boton para votar, no se podrá modificar más adelante-->
        <input type="submit" value="Votar" class="btn btn-warning">
        </form>





    </div>
</div>
</div>
@endsection