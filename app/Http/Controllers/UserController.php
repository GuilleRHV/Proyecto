<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Game;
use App\Models\Usuario;
use App\Models\Votacion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $this->authorize('viewAny', User::class);
        $userList = User::all();
        return view('user.index', ['userList' => $userList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("user.create");
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


            "name" => "required",

            "email" => "required",
            "password" => "required"
        ], [

            "name.required" => "El nombre es obvligatorio",

            "email.required" => "El email es obvligatorio"

        ]);
        $usuario = new User;
        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');
        $usuario->password = Hash::make($request->input('password'));
        $usuario->rol = $request->input('rol');
        $usuario->save();



        // 'password' => Hash::make($data['password']),
        // User::create($request->all());
        //return redirect("users.index")->with("exito","usere creado correctamente");
        return redirect()->route('users.index')->with('exito', 'usere creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', ['user' => $user]);
    }

    public function verMiBiblioteca()
    {
        $user = auth()->user();
        $gameList = array();
        if ($user->coleccion != null) {
            foreach (json_decode($user->coleccion) as $i) {
                $gameList[] = Game::find((int)$i);
            }

            return view('user.coleccion', ['user' => $user, 'gameList' => $gameList]);
        } else {
            $user = Auth::user();

            return redirect()->route('proyects.index')->with('gameList', $gameList);
        }
    }



    public function eliminarDeMiBiblioteca(User $user, Game $game)
    {
        $gameList = Game::all();

        $userAuth = auth()->user();

        if ($user->id != $userAuth->id) {
            return redirect()->route('proyects.index')->with('gameList', $gameList);
        }
        if ($user->coleccion != null) {


            $array = json_decode($user->coleccion,true);
            $nuevoarray = array();
            foreach ($array as $i) {
                $nuevoarray[] = $i;
            }
            $arrayConEliminado = array_search($game->id, $nuevoarray);
   

            
                array_splice($array,$arrayConEliminado,1);
           
            /* foreach ($arrayConEliminado as $a){
                    $array[]=$arrayConEliminado;
                }

                $arr = array_pull($array,$game->id);*/
            //$arrayConEliminado->forget($game->id);
           
            $user->coleccion = json_encode($array);
            $user->save();
            return redirect()->route('users.verMiBiblioteca');
           
        }


        // $this->verMiBiblioteca($user);

    }


    public function perfil(){
        $user = auth()->user();
        return view('user.perfil', ['user' => $user]);
    }

    public function cambiarpassword(){
        $user=auth()->user();
        return view('user.cambiarpassword', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
  
        $user=Usuario::find($id);
       $password=$user->password;
        $request->validate([

            "name" => "required",
           "nuevapassword"=>'|min:8|different:'.$user->password,
           "repitenuevapassword"=>"same:nuevapassword"
           

        ], [
            "name.required" => "El dni es obligatorio",
            "email.required" => "El nombre es obligatorio",
            "repitenuevapassword.same"=>"Repite la nueva contraseña correctamente",
            "nuevapassword"=>"La nueva contraseña debe tener al menos 8 caracteres",
            "nuevapassword.different"=>"La nueva contraseña debe ser diferente a la actual"

      

        ]);
      

    

        $user->name = $request->input("name");
       
      
        if($request->input("nuevapassword")!=null){
            $user->password = Hash::make($request['nuevapassword']);
            
        }
        

        $user->save();
        return redirect()->route('proyects.index')->with("exito", "Modificado exitosamente");
    }



    public function formcambiarpassword(Request $request,$id){
        $user=Usuario::find($id);
       $password=$user->password;
        $request->validate([

            "nuevapassword"=>"required|min:8",
         
           "repitenuevapassword"=>"required|same:nuevapassword"
           

        ], [
            "password.same"=>"Contraseña actual incorrecta",
            "repitenuevapassword.same"=>"Repite la nueva contraseña correctamente",
            "nuevapassword.min"=>"La nueva contraseña debe tener al menos 8 caracteres",
            

      

        ]);
        $user->password = Hash::make($request['nuevapassword']);
        $user->save();
        return redirect()->route('proyects.index')->with("exito", "Modificado exitosamente");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with("exito", "Eliminado exitosamente");
    }
}
