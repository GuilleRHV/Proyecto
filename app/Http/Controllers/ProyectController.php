<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\User;
use App\Models\Votacion;
use Illuminate\Support\Facades\Auth;
use App\Mail\GameMail;
use Illuminate\Support\Facades\Mail;
class ProyectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Te identifica
        $user = Auth::user();

        //Pagina por 10
        $votacionesList = Votacion::all();
        $gameList = Game::paginate(10);
        
        //Query=busqueda de videojuegos
        return view('proyect.index', ['gameList' => $gameList, 'user' => $user, 'votacionesList' => $votacionesList, 'query' => null, 'resultados' => null]);
    }


    public function all(Request $request)
    {
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
