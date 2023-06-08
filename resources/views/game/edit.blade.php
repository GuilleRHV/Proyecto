@extends('layouts.app')

@section('content')
<div class="container" style="background-color: white;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Editar videojuego</h1>
            <a href="{{route('proyects.index')}}" class="btn btn-primary">Home</a>

            <hr>
            <!--Errores del formulario -->
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


            <form action="{{route('games.update',$game->id)}}" method="post" enctype="multipart/form-data">
                @csrf

                @method("PUT")

                <!--Nombre juego-->
                <div class="row align-self-center">
                    <div class="col col-md-4 mb-8 ">
                        <div class="form-outline">
                            <label class="form-label" for="form3Example1">Nombre</label>
                            <input type="text" id="form3Example1" class="form-control  bordesredondeados " name="nombre" value="{{ $game->nombre ?? '' }}" />
                        </div>
                    </div>
                </div>
                <!--Descripcion juego-->
                <div class=" mb-4">
                    <div class="form-outline">
                        <label class="form-label" for="form3Example2">Descripcion</label>
                        
                        <textarea class="form-control bordesredondeados" rows="2" name="descripcion"  style="min-height: 150px">{{ $game->descripcion ?? '' }}</textarea>
                    </div>
                </div>

                <div class="row">
                    <!--Año de lanzamiento del juego-->
                    <div class="col-md-6 mb-4">
                        <label class="form-label" for="anyoLanzamiento">Año de lanzamiento</label>
                        <input type="text" id="anyoLanzamiento" class="form-control bordesredondeados" name="anyoLanzamiento" value="{{ $game->anyoLanzamiento ?? '' }}" />

                    </div>
                    <!--Precio de juego-->
                    <div class="col-md-6 mb-4">
                        <label class="form-label" for="precio">Precio</label>
                        <input type="text" id="precio" class="form-control  bordesredondeados" name="precio" value="{{ $game->precio ?? '' }}" />

                    </div>
                </div>

                <div class="row">
                    <!--Generos del juego (mira que opciones están marcadas)-->
                    <div class="form-outline mb-4 col-md-6">
                        <label for="generos">Generos</label><br>
                        <select class="form-select" name="generos[]" multiple>

                            <option value="accion" <?php foreach ($game->generos as $genero) {
                                                        if ($genero == "accion") {
                                                            echo "selected";
                                                        }
                                                    } ?>>accion</option>
                            <option value="aventura" <?php foreach ($game->generos as $genero) {
                                                            if ($genero == "aventura") {
                                                                echo "selected";
                                                            }
                                                        } ?>>aventura</option>
                            <option value="rpg" <?php foreach ($game->generos as $genero) {
                                                    if ($genero == "rpg") {
                                                        echo "selected";
                                                    }
                                                } ?>>rpg</option>
                            <option value="misterio" <?php foreach ($game->generos as $genero) {
                                                            if ($genero == "misterio") {
                                                                echo "selected";
                                                            }
                                                        } ?>>misterio</option>
                            <option value="peleas" <?php foreach ($game->generos as $genero) {
                                                        if ($genero == "peleas") {
                                                            echo "selected";
                                                        }
                                                    } ?>>peleas</option>
                            <option value="puzles" <?php foreach ($game->generos as $genero) {
                                                        if ($genero == "puzles") {
                                                            echo "selected";
                                                        }
                                                    } ?>>puzles</option>
                            <option value="metroivania" <?php foreach ($game->generos as $genero) {
                                                            if ($genero == "metroivania") {
                                                                echo "selected";
                                                            }
                                                        } ?>>metroivania</option>
                            <option value="arcade" <?php foreach ($game->generos as $genero) {
                                                        if ($genero == "arcade") {
                                                            echo "selected";
                                                        }
                                                    } ?>>arcade</option>
                            <option value="simulacion" <?php foreach ($game->generos as $genero) {
                                                            if ($genero == "simulacion") {
                                                                echo "selected";
                                                            }
                                                        } ?>>simulacion</option>
                            <option value="musica" <?php foreach ($game->generos as $genero) {
                                                        if ($genero == "musica") {
                                                            echo "selected";
                                                        }
                                                    } ?>>musica</option>
                            <option value="estrategia" <?php foreach ($game->generos as $genero) {
                                                            if ($genero == "estrategia") {
                                                                echo "selected";
                                                            }
                                                        } ?>>estrategia</option>
                            <option value="historia" <?php foreach ($game->generos as $genero) {
                                                            if ($genero == "historia") {
                                                                echo "selected";
                                                            }
                                                        } ?>>historia</option>





                        </select>

                    </div>
                    <!--Plataformas del juego (mira que opciones están marcadas)-->
                    <div class="form-outline mb-4 col-md-6">
                        <label for="precio">Plataformas</label><br>
                        <select class="form-select" name="plataformas[]" multiple>

                            <option value="PC" <?php
                                                foreach ($game->plataformas as $plataforma) {
                                                    if ($plataforma == "PC") {
                                                        echo "selected";
                                                    }
                                                } ?>>pc</option>
                            <option value="PS1" <?php foreach ($game->plataformas as $plataforma) {
                                                    if ($plataforma == "PS1") {
                                                        echo "selected";
                                                    }
                                                } ?>>ps1</option>
                            <option value="PS2" <?php foreach ($game->plataformas as $plataforma) {
                                                    if ($plataforma == "PS2") {
                                                        echo "selected";
                                                    }
                                                } ?>>ps2</option>
                            <option value="PS3" <?php foreach ($game->plataformas as $plataforma) {
                                                    if ($plataforma == "PS3") {
                                                        echo "selected";
                                                    }
                                                } ?>>ps3</option>
                            <option value="PS4" <?php foreach ($game->plataformas as $plataforma) {
                                                    if ($plataforma == "PS4") {
                                                        echo "selected";
                                                    }
                                                } ?>>ps4</option>
                            <option value="PS5" <?php foreach ($game->plataformas as $plataforma) {
                                                    if ($plataforma == "PS5") {
                                                        echo "selected";
                                                    }
                                                } ?>>ps5</option>
                            <option value="Xbox" <?php foreach ($game->plataformas as $plataforma) {
                                                        if ($plataforma == "Xbox") {
                                                            echo "selected";
                                                        }
                                                    } ?>>xbox</option>
                            <option value="Xbox360" <?php foreach ($game->plataformas as $plataforma) {
                                                        if ($plataforma == "Xbox360") {
                                                            echo "selected";
                                                        }
                                                    } ?>>xbox360</option>
                            <option value="XboxOne" <?php foreach ($game->plataformas as $plataforma) {
                                                        if ($plataforma == "XboxOne") {
                                                            echo "selected";
                                                        }
                                                    } ?>>xboxone</option>
                            <option value="XboxSeriesX" <?php foreach ($game->plataformas as $plataforma) {
                                                            if ($plataforma == "XboxSeriesX") {
                                                                echo "selected";
                                                            }
                                                        } ?>>xboxseriesx</option>
                            <option value="Nintendo64" <?php foreach ($game->plataformas as $plataforma) {
                                                            if ($plataforma == "Nintendo64") {
                                                                echo "selected";
                                                            }
                                                        } ?>>nintendo64</option>
                            <option value="Gameboy" <?php foreach ($game->plataformas as $plataforma) {
                                                        if ($plataforma == "Gameboy") {
                                                            echo "selected";
                                                        }
                                                    } ?>>gameboy</option>
                            <option value="NintendoDS" <?php foreach ($game->plataformas as $plataforma) {
                                                            if ($plataforma == "NintendoDS") {
                                                                echo "selected";
                                                            }
                                                        } ?>>nintendo ds</option>
                            <option value="Nintendo3ds" <?php foreach ($game->plataformas as $plataforma) {
                                                            if ($plataforma == "Nintendo3ds") {
                                                                echo "selected";
                                                            }
                                                        } ?>>nintendo 3ds</option>
                            <option value="Wii" <?php foreach ($game->plataformas as $plataforma) {
                                                    if ($plataforma == "Wii") {
                                                        echo "selected";
                                                    }
                                                } ?>>wii</option>
                            <option value="WiiU" <?php foreach ($game->plataformas as $plataforma) {
                                                        if ($plataforma == "WiiU") {
                                                            echo "selected";
                                                        }
                                                    } ?>>wiiu</option>
                            <option value="NintendoSwitch" <?php foreach ($game->plataformas as $plataforma) {
                                                                if ($plataforma == "NintendoSwitch") {
                                                                    echo "selected";
                                                                }
                                                            } ?>>nintendo switch</option>

                        </select>


                    </div>
                </div>
                <!--Imagen de juego -->
                <div class="mb-3">
                    <label for="formFile" class="form-label">Imagen del videojuego</label>
                    <input class="form-control" type="file" id="imagenjuego" name="imagenjuego">
                </div>

                <!--Boton actualizar juego -->
           
                <button type="submit" class="btn btn-warning"><span class="fa fa-pencil"></span>&nbsp;</button>
            </form>
            <!--Muestra el juego-->
            <a class="btn btn" href="{{ route('games.show',$game->id) }}" style="background-color: #9AD3E6"><span class="fa fa-eye"></span>&nbsp;</a>



        </div>
    </div>
</div>
@endsection