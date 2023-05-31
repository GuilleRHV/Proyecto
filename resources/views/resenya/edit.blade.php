@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Editar reseña</h1>
            <a href="{{route('games.index')}}" class="btn btn-primary">Index</a>

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


            <form action="{{route('resenyas.update',$resenya->id)}}" method="post" enctype="multipart/form-data">
                @csrf

                @method("PUT")


                <div class="form-group">
                    <label for="titulo">Titulo</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $resenya->titulo ?? '' }}">
                    </label>
                </div>

                <div class="form-group">
                    <label for="nombre">contenido</label>
                    <input type="text" name="contenido" id="contenido" class="form-control" value="{{ $resenya->contenido ?? '' }}">
                    </label>
                </div>

             

                <div class="form-group">
                    <label for="puntuacion">puntuacion</label><br>
                    <select name="puntuacion" >
                        
                        <option value="1" <?php if($resenya->puntuacion==1){ echo "selected";}  ?>>1</option>
                        <option value="2" <?php if($resenya->puntuacion==2){ echo "selected";}  ?>>2</option>
                        <option value="3" <?php if($resenya->puntuacion==3){ echo "selected";}  ?>>3</option>
                        <option value="4" <?php if($resenya->puntuacion==4){ echo "selected";}  ?>>4</option>
                        <option value="5" <?php if($resenya->puntuacion==5){ echo "selected";}  ?>>5</option>
                        
                    
                    </select>

                </div>


               

                <div class="mb-3">
                    <label for="formFile" class="form-label">Imagen de la reseña</label>
                    <input class="form-control" type="file" id="imagen" name="imagen">
                </div>


               



                <input type="submit" value="Actualizar" class="btn btn-warning">
            </form>





        </div>
    </div>
</div>
@endsection