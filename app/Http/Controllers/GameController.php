<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $gameList = Game::all();
        return view('game.index',['gameList'=>$gameList]);
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
            'plataforma' => 'required|not_in:0',
            'anyo' => 'required',
        ], [
            'nombre.required' => 'El nombre es obligatiorio',
            'descripcion.required' => 'La descripcion es obligatioria',
            'plataforma.required' => 'El plataforma es obligatiorio',
            'nombre.max' => 'El nombre no puede tener mas de 100 caracteres',
            'plataforma.not_in' => 'El plataforma no debe ser 0'


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

        Game::create($request->all());

        return redirect()->route('games.index')->with('juegocreado', 'juego creado correctamente');
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
        $game = Game::find($id);
        

        
            //return $product;
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
            'nombre' => 'required|max:100',
            'descripcion' => 'required',
            'plataforma' => 'required',
            'anyo' => 'required|not_in:0'
        ], [
            'nombre.required' => 'El nombre es obligatiorio',
            'descripcion.required' => 'La descripcion es obligatioria',
            'plataforma.required' => 'La plataforma es obligatioria',
            'nombre.max' => 'El nombre no puede tener mas de 100 caracteres',
            'anyo.not_in' => 'El anyo no debe ser 0'


        ]);


        $game = Game::find($id);
        //Request ingameut del formulario (name)
        $game->nombre = $request->input('nombre');
        $game->descripcion = $request->input('descripcion');
        $game->plataforma = $request->input('plataforma');
        $game->anyo = $request->input('anyo');

        //USAMOS EL ELOQUENT PARA GUARDAR
        $game->save(); //Es un metodo de eloquent
        return redirect()->route('games.index')->with('modificado', 'juego actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p = Game::find($id);
        $p->delete();


        return redirect()->route('games.index')->with('eliminado', 'juego correctamente eliminado');
    }
}
