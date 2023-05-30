<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resenya;
use App\Models\Usuario;

class ResenyaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $resenyasList = Resenya::all();
        return view('resenya.index', ['resenyasList' => $resenyasList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("resenya.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $user = auth()->user();
        $request->validate([

            "titulo" => "required",
            "contenido" => "required",
            "puntuacion" => "required",
            
           

        ], [

            "titulo.required" => "El titulo es obligatorio",

            "contenido.required" => "El contenido es obligatorio",
            "puntuacion.required" => "La puntuacion es obligatorio",
            

        ]);
        $resenya = new Resenya();
        $tituloMayus = ucfirst($request->input("titulo"));
        $resenya->titulo = $tituloMayus;
        $resenya->contenido = $request->input("contenido");
        $resenya->puntuacion = $request->input("puntuacion");
        $resenya->user_id=$user->id;
        $resenya->nombreyapellido= Usuario::find($user->id)->name . " ".Usuario::find($user->id)->apellido;
        
        //****GUARDAR IMAGEN */

        //   $imagen = $request->file("imagenjuego");

        //$rutaimagen = $imagen->store("public/imagenes");

        //  $contenidoimagen = file_get_contents($imagen);



        //IMAGEN

        $imagen = $request->file("imagen");
        if($imagen!=null){
        $nombreimagen = basename($_FILES["imagen"]["name"]);
        $rutaimagen = $imagen->store("imagenesresenyas");


        $rutaalternativa = "../public/imagenesresenyas/";

        $rutacompleta = $rutaalternativa . $nombreimagen;
        $resenya->imagen = $rutaimagen;
        }

        $resenya->save();
        if($imagen!=null){
        $rutaimagen = $imagen->store("public/imagenesresenyas");
        $rutaimagen = "/" . $rutaimagen;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutacompleta)) {

            if (rename($rutacompleta, "../" . $rutaimagen)) {
                return redirect()->route('proyects.index')->with('resenyacreada', 'Reseña creada correctamente');
            }
        } else {
            dd("No conseguido");
        }
    }

        return redirect()->route('proyects.index')->with('resenyacreada', 'Reseña creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resenya = Resenya::find($id);
        $resenya->delete();
        return redirect()->route('resenyas.index')->with("resenyaeliminada", "Reseña eliminada exitosamente");

    }
}
