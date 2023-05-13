<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
Use App\Models\User;
use App\Models\Votacion;
use Illuminate\Support\Facades\Auth;
class ProyectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('viewAny', Client::class);
       /* $ordenarnombre = $request->get('orden');
        
        if ($ordenarnombre != null) {
            dd($ordenarnombre);

       /*     $gameList = Game::all()->sort(function ($a, $b) {
                return strcmp($a->nombre, $b->nombre);
            });
            return view('proyect.index', ['gameList' => $gameList]);*/
      //  } else {*/
            
            $user = Auth::user();
            $gameList = Game::all();
            $votacionesList=Votacion::all();
            return view('proyect.index', ['gameList' => $gameList,'user'=>$user,'votacionesList'=>$votacionesList]);
        //}
    }


   /* public function verMiBiblioteca(User $user){
        //Solo puedes actuar sobre tu usuario
        //dd("USER RECIBIDO ". $user->name  . "USER REAL TUYO: ".Auth::user()->name);
        $user = User::find($user->id);
        $userComprobacion = Auth::user();
        if ($user->email!=$userComprobacion->email || $user->password!=$userComprobacion->password){
            $gameList = Game::all();
            $user = Auth::user();
            return redirect('proyect.index', ['gameList' => $gameList,'user'=>$user]);
        }
        dd("ok");
       // dd("AUTH USER: ".Auth::user()->email );
        
    }*/






    public function indexNombre($orden)
    {

        // $this->authorize('viewAny', Client::class);
        // $gameList = Game::all();
        $gameList = Game::all()->sort(function ($a, $b) {
            return strcmp($a->nombre, $b->nombre);
        });
        return view('proyect.index', ['gameList' => $gameList]);
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
        //
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
