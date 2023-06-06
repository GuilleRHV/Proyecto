@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Crear votacion</h1>
            <a href="{{route('users.index')}}" class="btn btn-primary">Index</a>
            <!--Para acceder a esta vista tienes que ser un administrador-->
            <hr>
            <!--Alertas mensajes-->
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


            <!--Formulario creacion votaciones-->
            <form action="{{route('votaciones.store')}}" method="post">
                @csrf


                <div class="text-center">

                    <!--Titulo votacion-->
                    <div class="row align-self-center">
                        <div class="col col-md-4 mb-8 ">
                            <div class="form-outline">
                                <label class="form-label" for="form3Example1">Titulo</label>
                                <input type="text" id="form3Example1" class="form-control  bordesredondeados " name="nombre" />
                            </div>
                        </div>
                    </div>
                    <!--Descripcion votacion-->
                    <div class=" mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="form3Example2">Descripcion</label>
                            <input type="text" id="form3Example2" class="form-control bordesredondeados" name="descripcion" />

                        </div>
                    </div>
                    <!--Nombre del valor A de la votacion-->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label" for="valor1">Valor A</label>
                            <input type="text" id="valor2" class="form-control bordesredondeados" name="valor1" />

                        </div>
                        <!--Nombre del valor B de la votacion -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label" for="valor2">Valor B</label>
                            <input type="text" id="valor2" class="form-control  bordesredondeados" name="valor2" />

                        </div>
                    </div>




                </div>



                <!--Boton crear votacion-->
                <input type="submit" value="Crear" class="btn btn-success">
            </form>





        </div>
    </div>
</div>
@endsection