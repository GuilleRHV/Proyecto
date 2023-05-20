<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$game_id,$user_id)
    {
     
        $comentario = new Comentario();
        $comentario->user_id = $user_id;
        $comentario->juego_id = $game_id;
        $comentario->contenido = $request->input("contenidocomentario");

        $contComentariosEnEsteJuego = 1;
        $allComments = Comentario::all();
        foreach($allComments as $comment){
            if($comment->user_id == $user_id){
            $contComentariosEnEsteJuego++;
            }
        }
        $comentario->comentario_id = $contComentariosEnEsteJuego;
        $comentario->save();
        return redirect()->route('proyects.index')->with('exito', 'usuario creado correctamente');
        
    }

    public function responder(Request $request,$game_id,$user_id,Comentario $comentario){
        //dd("Ha llegado");


        $request->validate([


            "contenidocomentario" => "required",

           
        ], [

            "contenidocomentario.required" => "La respuesta no puede ser vacia",


        ]);
        $respuestacomentario = new Comentario();
        $respuestacomentario->user_id = $user_id;
        $respuestacomentario->juego_id = $game_id;
        $respuestacomentario->contenido = $request->input("contenidocomentario");

        $contComentariosEnEsteJuego = 1;
        $allComments = Comentario::all();
        foreach($allComments as $comment){
            if($comment->user_id == $user_id){
            $contComentariosEnEsteJuego++;
            }
        }
        $respuestacomentario->comentario_id = $contComentariosEnEsteJuego;
        $respuestacomentario->padre()->associate($comentario);
        //$comentario->hijos()->associate($respuestacomentario);
        $respuestacomentario->save();

        $game=Game::find($game_id);
        return redirect()->route('games.show',['game'=>$game])->with('exito', 'usuario creado correctamente');
     
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
