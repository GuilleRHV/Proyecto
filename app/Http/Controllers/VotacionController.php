<?php

namespace App\Http\Controllers;

use App\Models\Votacion;
use Illuminate\Http\Request;

class VotacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $votacionList=Votacion::all();
        return view('votacion.index', ['votacionList' => $votacionList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("votacion.create");
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
            "valor1" => "required",
            "valor2" => "required",
            

        ], [

            "nombre.required" => "El nombre es obligatorio",
            "valor1.required" => "El valor1 es obligatorio",
            "descripcion.required" => "La descripcion es obligatorio",
            "valor2.required" => "El valor2 es obligatorio",
            
        ]);
        $votacion = new Votacion();
        $votacion->nombre=$request->input("nombre");
        $votacion->descripcion=$request->input("descripcion");
        $votacion->nombreopcion1=$request->input("valor1");
        $votacion->nombreopcion2=$request->input("valor2");
        
        $votacion->save();
        return redirect()->route('votaciones.index')->with('adminexito', 'administrador creado correctamente');
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
        //
    }
}
