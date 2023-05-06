@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Crear votacion</h1>
            <a href="{{route('users.index')}}" class="btn btn-primary">Index</a>

            <hr>
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



            <form action="{{route('votaciones.store')}}" method="post">
                @csrf



              


                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
                    </label>
                </div>


                <div class="form-group">
                    <label for="email">descripcion</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="">
                    </label>
                </div>
                <div class="form-group">
                    <label for="email">Valor 1</label>
                    <input type="text" name="valor1" id="valor1" class="form-control" placeholder="valor 1">
                    </label>
                </div>
                <div class="form-group">
                    <label for="email">Valor 2</label>
                    <input type="text" name="valor2" id="valor2" class="form-control" placeholder="valor 2">
                    </label>
                </div>


                <input type="submit" value="Crear" class="btn btn-success">
            </form>





        </div>
    </div>
</div>
@endsection