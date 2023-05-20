@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Crear videojuego</h1>
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



            <form action="{{route('games.store')}}" method="post" enctype="multipart/form-data" id="formulariocrearvideojuegos">
                @csrf



                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
                    </label>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion">
                    </label>
                </div>
                <div class="form-group">
                    <label for="anyoLanzamiento">anyoLanzamiento</label>
                    <input type="text" name="anyoLanzamiento" id="anyoLanzamiento" class="form-control" placeholder="año de lanzamiento">
                    </label>
                </div>


                <div class="form-group">
                    <label for="precio">Generos</label><br>
                    <select name="generos[]" multiple>
                        <option value="accion">accion</option>
                        <option value="aventura">aventura</option>
                        <option value="rpg">rpg</option>
                        <option value="misterio">misterio</option>
                        <option value="pelieas">pelieas</option>
                        <option value="puzles">puzles</option>
                        <option value="metroivania">metroivania</option>
                        <option value="arcade">arcade</option>
                        <option value="simulacion">simulacion</option>
                        <option value="musica">musica</option>
                        <option value="estrategia">estrategia</option>
                        <option value="historia">historia</option>
                    </select>

                </div>

                <div class="form-group">
                    <label for="precio">Plataformas</label><br>
                    <select name="plataformas[]" multiple>
                        <option value="PC">pc</option>
                        <option value="ps1">ps1</option>
                        <option value="ps2">ps2</option>
                        <option value="ps3">ps3</option>
                        <option value="ps4">ps4</option>
                        <option value="ps5">ps5</option>
                        <option value="xbox">xbox</option>
                        <option value="xbox360">xbox360</option>
                        <option value="xboxone">xboxone</option>
                        <option value="xboxseriesx">xboxseriesx</option>
                        <option value="nintendo64">nintendo64</option>
                        <option value="gameboy">gameboy</option>
                        <option value="nintendods">nintendo ds</option>
                        <option value="nintendo3ds">nintendo 3ds</option>
                        <option value="wii">wii</option>
                        <option value="wiiu">wiiu</option>
                        <option value="nintendoswitch">nintendo switch</option>
                    </select>

                </div>





                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="text" name="precio" id="precio" class="form-control" placeholder="Precio">
                    </label>
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Imagen del videojuego</label>
                    <input class="form-control" type="file" id="imagenjuego" name="imagenjuego">
                </div>



                <input type="submit" value="Crear" class="btn btn-success">
            </form>





        </div>
    </div>
</div>
@endsection