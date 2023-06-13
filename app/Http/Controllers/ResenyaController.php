<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resenya;
use App\Models\ComentarioResenya;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class ResenyaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Te lleva al indice de reseñas
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
    //Te dirige a la vista del formulario de creacion de reseñas
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
    //Crea la reseña
    public function store(Request $request)
    {
        //La valida
        $user = auth()->user();
        $request->validate([

            "titulo" => "required|max:30",
            "contenido" => "required|max:1500",
            "puntuacion" => "required",
            "pros" => "max:300",
            "contras" => "max:300",
            "imagen" => "image|mimes:jpg,png,jpeg,svg|dimensions:min_width=100,min_heigh=100"


        ], [

            "titulo.required" => "El titulo es obligatorio",
            "titulo.max" => "El título solo puede tener hasta 30 caracteres",
            "contenido.max" => "El contenido solo puede tener hasta 1500 caracteres",
            "pros.max" => "Los pros solo pueden tener hasta 300 caracteres",
            "contras.max" => "Las contras solo pueden tener hasta 300 caracteres",
            "contenido.required" => "El contenido es obligatorio",
            "puntuacion.required" => "La puntuacion es obligatorio",
            "imagen.image" => "El archivo debe ser una imagen",
            "imagen.mimes" => "La imagen debe tener extension jpg,jpeg,gif o svg",
            "imagen.dimensions" => "La imagen debe tener unas dimensiones minimas de 100x100 px"

        ]);
        //La crea
        $resenya = new Resenya();
        $tituloMayus = ucfirst($request->input("titulo"));
        $resenya->titulo = $tituloMayus;
        $resenya->contenido = ucfirst($request->input("contenido"));
        $resenya->pros = ucfirst($request->input("pros"));
        $resenya->contras = ucfirst($request->input("contras"));
        $resenya->puntuacion = $request->input("puntuacion");
        $resenya->user_id = $user->id;
        //Te pone como autor de la reseña
        $resenya->nombreyapellido = Usuario::find($user->id)->name . " " . Usuario::find($user->id)->apellido;

        //****GUARDAR IMAGEN */

        //IMAGEN

        $imagen = $request->file("imagen");
        if ($imagen != null) {
            $nombreimagen = basename($_FILES["imagen"]["name"]);
            $rutaimagen = $imagen->store("imagenesresenyas");


            $rutaalternativa = "../public/imagenesresenyas/";

            $rutacompleta = $rutaalternativa . $nombreimagen;
            $resenya->imagen = $rutaimagen;
        }
        //Te guarda la direccion de la imagen en la bbdd
        $resenya->save();
        //Te guarda la imagen en carpeta
        if ($imagen != null) {
            $rutaimagen = $imagen->store("public/imagenesresenyas");
            $rutaimagen = "/" . $rutaimagen;

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutacompleta)) {

                if (rename($rutacompleta, "../" . $rutaimagen)) {
                    return redirect()->route('resenyas.index')->with('resenyacreada', 'Reseña creada correctamente');
                }
            } else {
                dd("No conseguido");
            }
        }

        return redirect()->route('resenyas.index')->with('resenyacreada', 'Reseña creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Te muestra los detalles de una reseña
    public function show($id)
    {
        $resenya = Resenya::find($id);
        $user = Auth::user();



        if ($user == null) {
            $user = "No eres un usuario";
        }

        //Verifica que hayan comentarios
        $comentarios = ComentarioResenya::all();
        if ($comentarios->count() == 0) {
            $comentarios = null;
        }
        $arraycomentarios = [];
        if (!$comentarios == null) {
            foreach ($comentarios as $comentario) {
                if ($comentario->resenya_id == $resenya->id) {
                    $arraycomentarios[] = $comentario;
                }
            }
        }
        if (count($arraycomentarios) == 0) {
            $arraycomentarios = [];
        }

        return view('resenya.show', ['resenya' => $resenya, 'user' => $user, 'comentariosresenya' => $arraycomentarios]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Te dirige al formulario de edicion de reseñas
    public function edit($id)
    {
        $resenya = Resenya::find($id);
        return view('resenya.edit', ['resenya' => $resenya]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Te actualiza la reseña
    public function update(Request $request, $id)
    {
        //Valida los datos
        $request->validate([

            "titulo" => "required|max:30",
            "contenido" => "required|max:1500",
            "pros" => "max:300",
            "contras" => "max:300",
            "puntuacion" => "required",

            "imagen" => "image|mimes:jpg,png,jpeg,svg|dimensions:min_width=100,min_heigh=100"
        ], [

            "titulo.required" => "El titulo es obligatorio",
            "titulo.max" => "El título solo puede tener hasta 30 caracteres",
            "contenido.max" => "El contenido solo puede tener hasta 1500 caracteres",
            "pros.max" => "Los pros solo pueden tener hasta 300 caracteres",
            "contras.max" => "Las contras solo pueden tener hasta 300 caracteres",
            "contenido.required" => "La contenido es obligatorio",
            "puntuacion.required" => "El puntuacion es obligatorio",
            "imagen.image" => "El archivo debe ser una imagen",
            "imagen.mimes" => "La imagen debe tener extension jpg,jpeg,gif o svg",
            "imagen.dimensions" => "La imagen debe tener unas dimensiones minimas de 100x100 px"

        ]);
        //La actualiza
        $resenya = Resenya::find($id);
        $nombreMayus = ucfirst($request->input("titulo"));
        $resenya->titulo = $nombreMayus;
        $resenya->contenido = ucfirst($request->input("contenido"));
        $resenya->pros = ucfirst($request->input("pros"));
        $resenya->contras = ucfirst($request->input("contras"));
        $resenya->puntuacion = $request->input("puntuacion");




        $imagen = $request->file("imagen");

        //Verifica la exitencia de imagenes y las guarda en carpeta
        if ($imagen != null) {

            //Borrar la que tenemos
            if ($resenya->imagen != null) {
                $imagen_path_actual = public_path() . '/' . $resenya->imagen;
                unlink($imagen_path_actual);
            }


            $nombreimagen = basename($_FILES["imagen"]["name"]);
            $rutaimagen = $imagen->store("imagenesresenyas");


            $rutaalternativa = "../public/imagenesresenyas/";

            $rutacompleta = $rutaalternativa . $nombreimagen;
            $resenya->imagen = $rutaimagen;
            $resenya->save();
        } else {
            $resenya->save();
        }


        if ($imagen != null) {
            $rutaimagen = $imagen->store("public/imagenesresenyas");
            $rutaimagen = "/" . $rutaimagen;

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutacompleta)) {

                if (rename($rutacompleta, "../" . $rutaimagen)) {
                    return redirect()->route('resenyas.index')->with('resenyamodificada', 'Reseña modificada correctamente');
                }
            } else {
                dd("No conseguido");
            }
        }
        return redirect()->route('resenyas.index')->with('resenyamodificada', 'Reseña modificada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Elimina la reseña pasada
    public function destroy($id)
    {
        $resenya = Resenya::find($id);
        $resenya->delete();
        return redirect()->route('resenyas.index')->with("resenyaeliminada", "Reseña eliminada exitosamente");
    }
}
