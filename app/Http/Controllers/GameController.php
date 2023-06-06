<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isWritable;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("game.create");
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function agregarAColeccion(User $user, Game $game)
    {

        //Añadirá videojuegos a tu coleccion


        //Si tu coleccion es nula, añade el juego
        if ($user->coleccion == null) {
            $coleccionUser[] = $game->id;
        } else {
            //Si no es nula decodea tu coleccion de la bbdd y le añade el juego
            $coleccionUser = json_decode($user->coleccion);
            if (!in_array($game->id, $coleccionUser)) {
                $coleccionUser[] = $game->id;
            }
        }
        //Encodea la coleccion para guardarla en la bbdd
        $user->coleccion = json_encode($coleccionUser);
        //Guarda la coleccion
        $user->save();
        //Te redirige al index
        return redirect()->route('proyects.index')->with("agregadoacoleccion", "Has añadido un videojuego a tu colección");
    }
    public function store(Request $request)
    {
        //Crea un videojuego
        $request->validate([

            "nombre" => "required",
            "descripcion" => "required",
            "anyoLanzamiento" => "required|integer|min:1952",
            "generos" => "required",
            "plataformas" => "required",
            "precio" => "required|numeric|regex:/^\d+(\.\d{1,2})?$/",
            "imagenjuego" => "image|mimes:jpg,png,jpeg,svg|dimensions:min_width=100,min_heigh=100"
        ], [

            "nombre.required" => "El nombre es obligatorio",

            "anyoLanzamiento.required" => "El anyoLanzamiento es obligatorio",
            "descripcion.required" => "La descripcion es obligatorio",
            "generos.required" => "El generos es obligatorio",
            "plataformas.required" => "El plataformas es obligatorio",
            "precio.required" => "El precio es obligatorio",
            "precio.numeric" => "El precio debe ser un numero",
            "precio.regex" => "El precio debe tener un valor numerico",
            "anyoLanzamiento.integer" => "El anyoLanzamiento debe ser un numero",
            "anyoLanzamiento.min" => "El anyoLanzamiento debe ser posterior a 1952 (primer videojuego)",
            "imagenjuego.image" => "El archivo debe ser una imagen",
            "imagenjuego.mimes" => "La imagen debe tener extension jpg,jpeg,gif o svg",
            "imagenjuego.dimensions" => "La imagen debe tener unas dimensiones minimas de 100x100 px"

        ]);
        //Recibe los datos del formulario
        $game = new Game();
        $nombreMayus = ucfirst($request->input("nombre"));
        $game->nombre = $nombreMayus;
        $game->descripcion = $request->input("descripcion");
        $game->anyoLanzamiento = $request->input("anyoLanzamiento");
        $generosarray = [];
        //Los campos generos y plataformas son arrays
        $generos = $request->input("generos", []);

        $game->generos = $generos;
        $plataformas = $request->input("plataformas", []);
        $game->plataformas = $plataformas;
        $game->precio = $request->input("precio");





        //IMAGEN

        $imagen = $request->file("imagenjuego");
        if ($imagen != null) {
            $nombreimagen = basename($_FILES["imagenjuego"]["name"]);
            //Guarda la ruta como añadido de la carpeta imagenes
            $rutaimagen = $imagen->store("imagenes");


            $rutaalternativa = "../public/imagenes/";

            $rutacompleta = $rutaalternativa . $nombreimagen;
            $game->imagen = $rutaimagen;
        }
        //Guardamos la ruta de la imagen en la bbdd
        $game->save();
        //Ahora moveremos la imagen a la carpeta que hemos visto antes(imagenes)
        if ($imagen != null) {
            $rutaimagen = $imagen->store("public/imagenes");
            $rutaimagen = "/" . $rutaimagen;

            if (move_uploaded_file($_FILES['imagenjuego']['tmp_name'], $rutacompleta)) {

                if (rename($rutacompleta, "../" . $rutaimagen)) {
                    //Redirige al index
                    return redirect()->route('proyects.index')->with('juegocreado', 'Videojuego creado correctamente');
                }
            } else {
                dd("No conseguido");
            }
        }
        //Redirige al index
        return redirect()->route('proyects.index')->with('juegocreado', 'Videojuego creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function show($id)
    {
        //Pasa como parametros el juego en concreto, el usuario (si es que existe) y los comentarios del juego
        $game = Game::find($id);

        $user = Auth::user();



        if ($user == null) {
            $user = "No eres un usuario";
        }

        //Primero ver que existen comentarios en general (sino al recorrerlo nos dara errores)
        $comentarios = Comentario::all();
        if ($comentarios->count() == 0) {
            $comentarios = null;
        }


        //Aqui guardaremos los comentarios de este juego
        $arraycomentarios = [];
        if (!$comentarios == null) {
            //Ver si hay comentarios de este juego en concreto y añadirlos a un array
            foreach ($comentarios as $comentario) {
                if ($comentario->juego_id == $game->id) {
                    $arraycomentarios[] = $comentario;
                }
            }
        }
        if (count($arraycomentarios) == 0) {
            $arraycomentarios = [];
        }
        //Ir a la vista show con los parametros anteriores
        return view('game.show', ['game' => $game, 'user' => $user, 'comentarios' => $arraycomentarios]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Editar un juego
        $game = Game::find($id);
        return view('game.edit', ['game' => $game]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Modificar un videojuego
        $request->validate([

            "nombre" => "required",
            "descripcion" => "required",
            "anyoLanzamiento" => "required|integer|min:1952",
            "generos" => "required",
            "plataformas" => "required",
            "precio" => "required|numeric|regex:/^\d+(\.\d{1,2})?$/",
            "imagenjuego" => "image|mimes:jpg,png,jpeg,svg|dimensions:min_width=100,min_heigh=100"
        ], [

            "nombre.required" => "El nombre es obligatorio",

            "anyoLanzamiento.required" => "El anyoLanzamiento es obligatorio",
            "descripcion.required" => "La descripcion es obligatorio",
            "generos.required" => "El generos es obligatorio",
            "plataformas.required" => "El plataformas es obligatorio",
            "precio.required" => "El precio es obligatorio",
            "precio.numeric" => "El precio debe ser un numero",
            "precio.regex" => "El precio debe tener un valor numerico",
            "anyoLanzamiento.integer" => "El anyoLanzamiento debe ser un numero",
            "anyoLanzamiento.min" => "El anyoLanzamiento debe ser posterior a 1952 (primer videojuego)",
            "imagenjuego.image" => "El archivo debe ser una imagen",
            "imagenjuego.mimes" => "La imagen debe tener extension jpg,jpeg,gif o svg",
            "imagenjuego.dimensions" => "La imagen debe tener unas dimensiones minimas de 100x100 px"

        ]);
        //Actualiza los datos del juego con los datos del formulario
        $game = Game::find($id);
        $nombreMayus = ucfirst($request->input("nombre"));
        $game->nombre = $nombreMayus;
        $game->descripcion = $request->input("descripcion");
        $game->anyoLanzamiento = $request->input("anyoLanzamiento");
        $generosarray = [];
        //Generos y plataformas son arrays
        $generos = $request->input("generos", []);

        $game->generos = $generos;
        $plataformas = $request->input("plataformas", []);
        $game->plataformas = $plataformas;
        $game->precio = $request->input("precio");

        //****GUARDAR IMAGEN */



        //IMAGEN

        $imagen = $request->file("imagenjuego");
        //La imagen es opcional
        if ($imagen != null) {
            $nombreimagen = basename($_FILES["imagenjuego"]["name"]);
            $rutaimagen = $imagen->store("imagenes");
            //guarda la ruta para la carpeta imagenes

            $rutaalternativa = "../public/imagenes/";
            //Concatenacion con los nombres
            $rutacompleta = $rutaalternativa . $nombreimagen;

            $game->imagen = $rutaimagen;
        }
        //Guardamos la ruta de la imagen en la bbdd
        $game->save();
        //Ahora moveremos la imagen a la carpeta que hemos visto antes(imagenes)
        if ($imagen != null) {
            $rutaimagen = $imagen->store("public/imagenes");
            $rutaimagen = "/" . $rutaimagen;

            if (move_uploaded_file($_FILES['imagenjuego']['tmp_name'], $rutacompleta)) {

                if (rename($rutacompleta, "../" . $rutaimagen)) {
                    //Redirige al idex
                    return redirect()->route('proyects.index')->with('juegomodificado', 'Videojuego modificado correctamente');
                }
            } else {
                dd("No conseguido");
            }
        }
        //Redirige al index
        return redirect()->route('proyects.index')->with('juegomodificado', 'Videojuego modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Eliminar un videojuego por id
        $game = Game::find($id);
        $game->delete();
        return redirect()->route('proyects.index')->with("juegoeliminado", "Videojuego eliminado exitosamente");
    }
}
