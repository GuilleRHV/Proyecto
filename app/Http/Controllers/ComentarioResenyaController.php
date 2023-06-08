<?php

namespace App\Http\Controllers;

use App\Models\ComentarioResenya;
use App\Models\Resenya;
use Illuminate\Http\Request;

class ComentarioResenyaController extends Controller
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
    public function store(Request $request,$resenya_id,$user_id)
    {

        $request->validate([
            "contenidocomentario" => "required|string|max:300",
        ], [
            "contenidocomentario.required" => "El comentario no puede estar vacio",
            "contenidocomentario.max" => "Solo puedes escribir hasta 300 caracteres"
           
        ]);
        $comentario = new ComentarioResenya();
        $comentario->user_id = $user_id;
        $comentario->resenya_id = $resenya_id;
        $comentario->contenido = $request->input("contenidocomentario");

        $contComentarioEnEstaResenya = 1;
        $allComments = ComentarioResenya::all();
        foreach($allComments as $comment){
            if($comment->user_id == $user_id){
            $contComentarioEnEstaResenya++;
            }
        }
        $comentario->comentario_id = $contComentarioEnEstaResenya;
        $comentario->save();
        $resenya=Resenya::find($resenya_id);
        return redirect()->route('resenyas.show',['resenya'=>$resenya])->with('comentariocreado', 'Has escrito un comentario');
    }












    public function responder(Request $request,$resenya_id,$user_id,ComentarioResenya $comentario){
        //dd("Ha llegado");


        $request->validate([


            "contenidocomentario" => "required",

           
        ], [

            "contenidocomentario.required" => "La respuesta no puede ser vacia",


        ]);
        $respuestacomentario = new ComentarioResenya();
        $respuestacomentario->user_id = $user_id;
        $respuestacomentario->resenya_id = $resenya_id;
        $respuestacomentario->contenido = $request->input("contenidocomentario");

        $contComentarioEnEstaResenya = 1;
        $allComments = ComentarioResenya::all();
        foreach($allComments as $comment){
            if($comment->user_id == $user_id){
            $contComentarioEnEstaResenya++;
            }
        }
        $respuestacomentario->comentario_id = $contComentarioEnEstaResenya;
        $respuestacomentario->padre()->associate($comentario);
        //$comentario->hijos()->associate($respuestacomentario);
        $respuestacomentario->save();

        $resenya=Resenya::find($resenya_id);
        return redirect()->route('resenyas.show',['resenya'=>$resenya])->with('respuesta', 'Has respondido a un comentario');
     
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
   
        $comentario = ComentarioResenya::find($id);
      
        $resenya_id=$comentario->resenya_id;
        $comentario->delete();
        return redirect()->route('resenyas.show',$resenya_id)->with("comentarioeliminado", "Has eliminado un comentario exitosamente");
    }
}
