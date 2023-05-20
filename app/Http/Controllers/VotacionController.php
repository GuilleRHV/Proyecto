<?php

namespace App\Http\Controllers;

use App\Models\Votacion;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class VotacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $votacionesList=Votacion::all();
        return view('votacion.index', ['votacionesList' => $votacionesList]);
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
        return redirect()->route('votaciones.index')->with('votacioncreada', 'Votacion creada correctamente');
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
        $votacion = Votacion::find($id);
        return view('votacion.edit', ['votacion' => $votacion]);
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

        $user = Auth::user();
        $user_id = $user->id;
        //dd($user_id);
        $request->validate([

            

        ], [
           


        ]);

        $votacion = Votacion::find($id);

        

        $participantes=array();

        if($votacion->participantes==null){
            $participantes[] = $user_id;
            if($request->input("valorvotacion")=='nombreopcion1'){
            
                $votacion->valoropcion1 = $votacion->valoropcion1+1;
            }else{
                $votacion->valoropcion2 = $votacion->valoropcion2+1;
            }
        }else{
           
            $participantes=json_decode($votacion->participantes);
            if(!in_array($user_id,$participantes)){
                $participantes[]=$user_id;
                if($request->input("valorvotacion")=='nombreopcion1'){
            
                    $votacion->valoropcion1 = $votacion->valoropcion1+1;
                }else{
                    $votacion->valoropcion2 = $votacion->valoropcion2+1;
                }
            }
           
    
   
        }
        
        $votacion->participantes = json_encode($participantes);
       
       
      
        $votacion->save();
        echo "<script>window.close();</script>";
        $user = Auth::user();
            $gameList = Game::all();
            $votacionesList=Votacion::all();
            return view('proyect.index', ['gameList' => $gameList,'user'=>$user,'votacionesList'=>$votacionesList]);
       
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
