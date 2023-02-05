@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Detalle del producto</h1>
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


            <form action="{{route('games.update',$game->id)}}" method="post">
                @csrf

                @method("PUT")

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="{{ $game->nombre ?? '' }}">
                    </label>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="{{ $game->descripcion ?? '' }}">
                    </label>
                </div>

                <div class="form-group">
                    <label for="precio">plataforma</label>
                    <input type="text" name="plataforma" id="plataforma" class="form-control" placeholder="{{ $game->plataforma ?? '' }}">
                    </label>
                </div>

                <div class="form-group">
                    <label for="precio">Año de lanzamiento</label>
                    <input type="text" name="anyo" id="anyo" class="form-control" placeholder="{{ $game->anyo ?? '' }}">
                    </label>
                </div>



                <input type="submit" value="Actualizar" class="btn btn-warning">
            </form>





        </div>
    </div>
</div>
@endsection