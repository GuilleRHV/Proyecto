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

     public function agregarAColeccion(User $user, Game $game){

       // $user->anyadirColeccionAttribute($game->id);
        


        if($user->coleccion==null){
            $coleccionUser[] = $game->id;
        }else{
           
            $coleccionUser=json_decode($user->coleccion);
            if(!in_array($game->id,$coleccionUser)){
                $coleccionUser[]=$game->id;
            }
           
    
   
        }
        
        $user->coleccion = json_encode($coleccionUser);
        $user->save();
        return redirect()->route('proyects.index')->with("exito", "Modificado exitosamente");


     }
    public function store(Request $request)
    {

        $request->validate([

            "nombre" => "required",
            "descripcion" => "required",
            "anyoLanzamiento" => "required|integer|min:1952",
            "generos" => "required",
            "plataformas" => "required",
            "precio" => "required|numeric|regex:/^\d+(\.\d{1,2})?$/",

        ], [

            "nombre.required" => "El nombre es obligatorio",

            "anyoLanzamiento.required" => "El anyoLanzamiento es obligatorio",
            "descripcion.required" => "La descripcion es obligatorio",
            "generos.required" => "El generos es obligatorio",
            "plataformas.required" => "El plataformas es obligatorio",
            "precio.required" => "El precio es obligatorio",
            "precio.regex" => "El precio debe tener un valor numerico",
            "anyoLanzamiento.integer" => "El anyoLanzamiento debe ser un numero",
            "anyoLanzamiento.min" => "El anyoLanzamiento debe ser posterior a 1952 (primer videojuego)",

        ]);
        $game = new Game();
        $nombreMayus = ucfirst($request->input("nombre"));
        $game->nombre = $nombreMayus;
        $game->descripcion = $request->input("descripcion");
        $game->anyoLanzamiento = $request->input("anyoLanzamiento");
        $generosarray = [];
        $generos = $request->input("generos", []);

        $game->generos = $generos;
        $plataformas = $request->input("plataformas", []);
        $game->plataformas = $plataformas;
        $game->precio = $request->input("precio");

        //****GUARDAR IMAGEN */

        //   $imagen = $request->file("imagenjuego");

        //$rutaimagen = $imagen->store("public/imagenes");

        //  $contenidoimagen = file_get_contents($imagen);



        //IMAGEN

        $imagen = $request->file("imagenjuego");
        if($imagen!=null){
        $nombreimagen = basename($_FILES["imagenjuego"]["name"]);
        $rutaimagen = $imagen->store("imagenes");


        $rutaalternativa = "../public/imagenes/";

        $rutacompleta = $rutaalternativa . $nombreimagen;
        $game->imagen = $rutaimagen;
        }

        $game->save();
        if($imagen!=null){
        $rutaimagen = $imagen->store("public/imagenes");
        $rutaimagen = "/" . $rutaimagen;

        if (move_uploaded_file($_FILES['imagenjuego']['tmp_name'], $rutacompleta)) {

            if (rename($rutacompleta, "../" . $rutaimagen)) {
                return redirect()->route('proyects.index')->with('juegocreado', 'Videojuego creado correctamente');
            }
        } else {
            dd("No conseguido");
        }
    }

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
        
        $game = Game::find($id);

        $user = Auth::user();

        
        
        if ($user == null) {
            $user = "No eres un usuario";
        }

        $comentarios = Comentario::all();
        if ($comentarios->count() == 0) {
            $comentarios = null;
        }


        $arraycomentarios = [];
        if(!$comentarios==null){
        foreach ($comentarios as $comentario) {
            if ($comentario->juego_id == $game->id) {
                $arraycomentarios[]=$comentario;
            }
        }
    }
        if(count($arraycomentarios)==0) {
            $arraycomentarios = [];
        }

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
        $request->validate([

            "nombre" => "required",
            "descripcion" => "required",
            "anyoLanzamiento" => "required|integer|min:1952",
            "generos" => "required",
            "plataformas" => "required",
            "precio" => "required|numeric|regex:/^\d+(\.\d{1,2})?$/",

        ], [

            "nombre.required" => "El nombre es obligatorio",

            "anyoLanzamiento.required" => "El anyoLanzamiento es obligatorio",
            "descripcion.required" => "La descripcion es obligatorio",
            "generos.required" => "El generos es obligatorio",
            "plataformas.required" => "El plataformas es obligatorio",
            "precio.required" => "El precio es obligatorio",
            "precio.regex" => "El precio debe tener un valor numerico",
            "anyoLanzamiento.integer" => "El anyoLanzamiento debe ser un numero",
            "anyoLanzamiento.min" => "El anyoLanzamiento debe ser posterior a 1952 (primer videojuego)",

        ]);
        $game = Game::find($id);
        $nombreMayus = ucfirst($request->input("nombre"));
        $game->nombre = $nombreMayus;
        $game->descripcion = $request->input("descripcion");
        $game->anyoLanzamiento = $request->input("anyoLanzamiento");
        $generosarray = [];
        $generos = $request->input("generos", []);

        $game->generos = $generos;
        $plataformas = $request->input("plataformas", []);
        $game->plataformas = $plataformas;
        $game->precio = $request->input("precio");

        //****GUARDAR IMAGEN */

        //   $imagen = $request->file("imagenjuego");

        //$rutaimagen = $imagen->store("public/imagenes");

        //  $contenidoimagen = file_get_contents($imagen);



        //IMAGEN

        $imagen = $request->file("imagenjuego");
        if($imagen!=null){
        $nombreimagen = basename($_FILES["imagenjuego"]["name"]);
        $rutaimagen = $imagen->store("imagenes");


        $rutaalternativa = "../public/imagenes/";

        $rutacompleta = $rutaalternativa . $nombreimagen;
        $game->imagen = $rutaimagen;
        }

        $game->save();
        if($imagen!=null){
        $rutaimagen = $imagen->store("public/imagenes");
        $rutaimagen = "/" . $rutaimagen;

        if (move_uploaded_file($_FILES['imagenjuego']['tmp_name'], $rutacompleta)) {

            if (rename($rutacompleta, "../" . $rutaimagen)) {
                return redirect()->route('proyects.index')->with('juegomodificado', 'Videojuego modificado correctamente');
            }
        } else {
            dd("No conseguido");
        }
    }

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
        $game = Game::find($id);
        $game->delete();
        return redirect()->route('proyects.index')->with("juegoeliminado", "Videojuego eliminado exitosamente");

    }

    public function indexPc()
    {

        $games = Game::all();
        $juegospc = [];

        foreach ($games as $game) {
            if (in_array("PC", $game->plataformas)) {
                $juegospc[] = $game;
            }
        }

        return view('game.indexpc', ['juegospc' => $juegospc]);
    }
}
