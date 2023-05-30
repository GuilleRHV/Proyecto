@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Crear resenya</h1>
            <a href="{{route('proyects.index')}}" class="btn btn-primary">Index</a>

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



            <form action="{{route('resenyas.store')}}" method="post" enctype="multipart/form-data" id="formulariocrearvideojuegos">
                @csrf



                <div class="form-group">
                    <label for="nombre">Titulo</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" placeholder="titulo">
                    </label>
                </div>

                <div class="form-group">
                    <label for="descripcion">contenido</label>
                    <input type="text" name="contenido" id="contenido" class="form-control" placeholder="contenido">
                    </label>
                </div>
               



                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="puntuacion">
  
  <option value="1" selected>1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
</select>

<div class="mb-3">
  <label for="formFile" class="form-label">Imagen reseña</label>
  <input class="form-control" type="file"  name="imagen">
</div>
              
                <input type="submit" value="Crear" class="btn btn-success">
            </form>





        </div>
    </div>
</div>
@endsection