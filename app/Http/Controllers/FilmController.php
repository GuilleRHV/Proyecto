<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $filmList = Film::all();
        return view('film.index',['filmList'=>$filmList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nombre' => 'required|max:100',
            'descripcion' => 'required',
            'genero' => 'required|not_in:0',
            'anyo' => 'required',
        ], [
            'nombre.required' => 'El nombre es obligatiorio',
            'descripcion.required' => 'La descripcion es obligatioria',
            'genero.required' => 'El genero es obligatiorio',
            'nombre.max' => 'El nombre no puede tener mas de 100 caracteres',
            'genero.not_in' => 'El genero no debe ser 0'


        ]);


        //METODO 1
        /*
        $producto = new Product;
        $producto->nombre=$request->input('nombre');
        $producto->descripcion=$request->input('descripcion');
        $producto->precio=$request->input('precio');
        $producto->save();
        */


        //METODO 2 (En el model Product se incluye):
        //protected $fillable = ['nombre', 'descripcion', 'precio'];

        Film::create($request->all());

        return redirect()->route('films.index')->with('juegocreado', 'juego creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         //Buscar producto

        //Buscar vista
        $film = Film::find($id);
        

        
            //return $product;
            return view('film.show', ['film' => $film]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $film = Film::find($id);
        return view('film.edit', ['film' => $film]);

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
            'nombre' => 'required|max:100',
            'descripcion' => 'required',
            'genero' => 'required',
            'anyo' => 'required|not_in:0'
        ], [
            'nombre.required' => 'El nombre es obligatiorio',
            'descripcion.required' => 'La descripcion es obligatioria',
            
            'nombre.max' => 'El nombre no puede tener mas de 100 caracteres',
            'anyo.not_in' => 'El anyo no debe ser 0'


        ]);


        $film = Film::find($id);
        //Request ingameut del formulario (name)
        $film->nombre = $request->input('nombre');
        $film->descripcion = $request->input('descripcion');
        $film->genero = $request->input('genero');
        $film->anyo = $request->input('anyo');

        //USAMOS EL ELOQUENT PARA GUARDAR
        $film->save(); //Es un metodo de eloquent
        return redirect()->route('films.index')->with('modificado', 'juego actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p = Film::find($id);
        $p->delete();


        return redirect()->route('films.index')->with('eliminado', 'juego correctamente eliminado');
    }
}
