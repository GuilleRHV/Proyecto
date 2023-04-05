<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

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
        //
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
    public function store(Request $request)
    {

        $request->validate([

            "nombre" => "required",
            "descripcion" => "required",
            "anyoLanzamiento" => "required",
            "generos" => "required",
            "plataformas" => "required",
            "precio" => "required",

        ], [

            "nombre.required" => "El nombre es obligatorio",

            "anyoLanzamiento.required" => "El anyoLanzamiento es obligatorio",
            "descripcion.required" => "La descripcion es obligatorio",
            "generos.required" => "El generos es obligatorio",
            "plataformas.required" => "El plataformas es obligatorio",
            "precio.required" => "El precio es obligatorio"

        ]);
        $game = new Game();

        $game->nombre = $request->input("nombre");
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

        $nombreimagen = basename($_FILES["imagenjuego"]["name"]);
        $rutaimagen = $imagen->store("imagenes");


        $rutaalternativa = "../public/imagenes/";

        $rutacompleta = $rutaalternativa . $nombreimagen;
        $game->imagen = $rutaimagen;

        $game->save();
        $rutaimagen = $imagen->store("public/imagenes");
        $rutaimagen = "/" . $rutaimagen;

        if (move_uploaded_file($_FILES['imagenjuego']['tmp_name'], $rutacompleta)) {

            if (rename($rutacompleta, "../" . $rutaimagen)) {
                return redirect()->route('proyects.index')->with('adminexito', 'administrador creado correctamente');
            }
        } else {
            dd("No conseguido");
        }

        return redirect()->route('proyects.index')->with('adminexito', 'administrador creado correctamente');
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
        
 
   
        return view('game.show', ['game' => $game]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        dd("updating");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function indexPc(){
       
        $games = Game::all();
        $juegospc = [];

        foreach($games as $game){
            if(in_array("PC", $game->plataformas)){
                $juegospc[]= $game;
            }
        }
      
        return view('game.indexpc', ['juegospc' => $juegospc]);
    }
}
