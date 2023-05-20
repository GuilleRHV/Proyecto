@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Editar videojuego</h1>
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
                    <label for="dni">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $game->nombre ?? '' }}">
                    </label>
                </div>

                <div class="form-group">
                    <label for="nombre">descripcion</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ $game->descripcion ?? '' }}">
                    </label>
                </div>

                <div class="form-group">
                    <label for="apellidos">anyoLanzamiento</label>
                    <input type="text" name="anyoLanzamiento" id="anyoLanzamiento" class="form-control" value="{{ $game->anyoLanzamiento ?? '' }}">
                    </label>
                </div>


                <div class="form-group">
                    <label for="precio">Generos</label><br>
                    <select name="generos[]" multiple>
                        @foreach($game->generos as $genero)
                        <option value="accion" {{ $genero=='accion' ? 'selected': '' }}>accion</option>
                        <option value="aventura" {{ $genero=="aventura" ? "selected": '' }}>aventura</option>
                        <option value="rpg" {{ $genero=="rpg" ? "selected": '' }}>rpg</option>
                        <option value="misterio" {{ $genero=="misterio" ? "selected": '' }}>misterio</option>
                        <option value="peleas" {{ $genero=="peleas" ? "selected": '' }}>peleas</option>
                        <option value="puzles" {{ $genero=="puzles" ? "selected": '' }}>puzles</option>
                        <option value="metroivania" {{ $genero=="metroivania" ? "selected": '' }}>metroivania</option>
                        <option value="arcade" {{ $genero=="arcade" ? "selected": '' }}>arcade</option>
                        <option value="simulacion" {{ $genero=="simulacion" ? "selected": '' }}>simulacion</option>
                        <option value="musica" {{ $genero=="musica" ? "selected": '' }}>musica</option>
                        <option value="estrategia" {{ $genero=="estrategia" ? "selected": '' }}>estrategia</option>
                        <option value="historia" {{ $genero=="historia" ? "selected": '' }}>historia</option>
                        @endforeach
                    </select>

                </div>


                <div class="form-group">
                    <label for="precio">Plataformas</label><br>
                    <select name="plataformas[]" multiple>
                    @foreach($game->plataformas as $plataformas)
                        <option value="PC" {{ $plataformas=='PC' ? 'selected': '' }}>pc</option>
                        <option value="ps1" {{ $plataformas=='ps1' ? 'selected': '' }}>ps1</option>
                        <option value="ps2" {{ $plataformas=='ps2' ? 'selected': '' }}>ps2</option>
                        <option value="PS3" {{ $plataformas=='PS3' ? 'selected': '' }}>ps3</option>
                        <option value="PS4" {{ $plataformas=='ps4' ? 'selected': '' }}>ps4</option>
                        <option value="PS5" {{ $plataformas=='ps5' ? 'selected': '' }}>ps5</option>
                        <option value="Xbox" {{ $plataformas=='Xbox' ? 'selected': '' }}>xbox</option>
                        <option value="Xbox360" {{ $plataformas=='Xbox360' ? 'selected': '' }}>xbox360</option>
                        <option value="XboxOne" {{ $plataformas=='XboxOne' ? 'selected': '' }}>XboxOne</option>
                        <option value="XboxSeriesX" {{ $plataformas=='XboxSeriesX' ? 'selected': '' }}>XboxSeriesX</option>
                        <option value="nintendo64" {{ $plataformas=='nintendo64' ? 'selected': '' }}>nintendo64</option>
                        <option value="gameboy" {{ $plataformas=='gameboy' ? 'selected': '' }}>gameboy</option>
                        <option value="nintendods" {{ $plataformas=='nintendods' ? 'selected': '' }}>nintendo ds</option>
                        <option value="nintendo3ds" {{ $plataformas=='nintendo3ds' ? 'selected': '' }}>nintendo 3ds</option>
                        <option value="wii" {{ $plataformas=='wii' ? 'selected': '' }}>wii</option>
                        <option value="wiiu" {{ $plataformas=='wiiu' ? 'selected': '' }}>wiiu</option>
                        <option value="Switch" {{ $plataformas=='Switch' ? 'selected': '' }}>nintendo switch</option>
                        @endforeach
                    </select>

                </div>





                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="text" name="precio" id="precio" class="form-control" value="{{ $game->precio ?? '' }}">
                    </label>
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Imagen del videojuego</label>
                    <input class="form-control" type="file" id="imagenjuego" name="imagenjuego">
                </div>


               



                <input type="submit" value="Actualizar" class="btn btn-warning">
            </form>





        </div>
    </div>
</div>
@endsection