<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Votacion;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       // return view('home');


        $user = Auth::user();
        $gameList=Game::paginate(10);
        $votacionesList=Votacion::all();
        return view('proyect.index', ['gameList' => $gameList,'user'=>$user,'votacionesList'=>$votacionesList,'query'=>null,'resultados'=>null]);
    }
}
