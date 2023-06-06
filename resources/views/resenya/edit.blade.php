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

                <div class="row align-self-center">
                    <div class="col col-md-4 mb-8 ">
                        <div class="form-outline">
                            <label class="form-label" for="formtitulo">Titulo</label>
                            <input type="text" id="form3Example1" class="form-control  bordesredondeados " name="titulo" value="{{ $resenya->titulo ?? '' }}"/>
                        </div>
                    </div>
                </div>
                <div class=" mb-4">
                    <div class="form-outline">
                        <label class="form-label" for="formcont">Contenido</label>
                        <input type="text" id="form3Example2" class="form-control bordesredondeados" name="contenido" value="{{ $resenya->contenido ?? '' }}" />

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-4">
                    <div class="form-outline">
                    <label class="form-label" for="formpuntuacion">Puntuacion</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="puntuacion">

                            <option value="1" <?php if($resenya->puntuacion==1){ echo "selected";}  ?>>1</option>
                            <option value="2"<?php if($resenya->puntuacion==2){ echo "selected";}  ?>>2</option>
                            <option value="3"<?php if($resenya->puntuacion==3){ echo "selected";}  ?>>3</option>
                            <option value="4"<?php if($resenya->puntuacion==4){ echo "selected";}  ?>>4</option>
                            <option value="5"<?php if($resenya->puntuacion==5){ echo "selected";}  ?>>5</option>
                        </select>
                    </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Imagen reseña</label>
                            <input class="form-control" type="file" name="imagen">
                        </div>

                    </div>
                </div>

                <input type="submit" value="Actualizar" class="btn btn-warning">
            </form>

            <a class="btn btn-warning" href="{{ route('resenyas.show',$resenya->id) }}" class="btn btn"><span class="fa fa-eye"></span>&nbsp;</a>



        </div>
    </div>
</div>
@endsection