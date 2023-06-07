<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$game_id,$user_id)
    {
     
        $request->validate([
            "contenidocomentario" => "required|string",
        ], [
            "contenidocomentario.required" => "El comentario no puede estar vacio",
        ]);
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
        $game=game::find($game_id);
        return redirect()->route('games.show',['game'=>$game])->with('comentariocreado', 'Has escrito un comentario');
        
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
        return redirect()->route('games.show',['game'=>$game])->with('respuesta', 'Has respondido a un comentario');
     
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comentario = Comentario::find($id);
      
        $juego_id=$comentario->juego_id;
        $comentario->delete();
        return redirect()->route('games.show',$juego_id)->with("comentarioeliminado", "Has eliminado un comentario exitosamente");
    }
}
