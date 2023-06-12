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

        //Dejo esto así por si en el futuro implementar creacion de usuarios desde vista grafica, pero actualmente no se usa

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
        //Ve quien es el usuario
        $user = auth()->user();
        $gameList = array();
        $colecciondecoded = json_decode($user->coleccion, true);
        $cont = 0;
        //mira a ver si tiene juegos en la coleccion
        if ($user->coleccion != null) {
            foreach (json_decode($user->coleccion) as $i) {
                $cont++;
            }
        }
        //Doble verificacion 
     
        if ($cont != 0) {
            foreach (json_decode($user->coleccion) as $i) {
                $gameList[] = Game::find((int)$i);
            }
            //Si tiene juegos en la coleccion/biblioteca puede acceder a la vista
            return view('user.coleccion', ['user' => $user, 'gameList' => $gameList]);
        } else {
            $user = Auth::user();
            //Si no tienes juegos en la coleccion/biblioteca te impide acceder a la vista y te manda una alerta
            return redirect()->route('proyects.index')->with(['gameList' => $gameList, 'coleccionvacia' => 'Parece que tienes la biblioteca vacia, añade juegos para acceder a ella']);
        }
    }



    public function eliminarDeMiBiblioteca(User $user, Game $game)
    {
        //Para eliminar juegos de la biblioteca
        $gameList = Game::all();
        //Te identifica
        $userAuth = auth()->user();
        //Mira que no intentas acceder como otro usuario
        if ($user->id != $userAuth->id) {
            return redirect()->route('proyects.index')->with('gameList', $gameList);
        }

        //Si tienes juegos en la coleccion busca y elimina
        if ($user->coleccion != null) {


            $array = json_decode($user->coleccion, true);
            $nuevoarray = array();
            foreach ($array as $i) {
                $nuevoarray[] = $i;
            }
            $arrayConEliminado = array_search($game->id, $nuevoarray);
            array_splice($array, $arrayConEliminado, 1);


            $user->coleccion = json_encode($array);
            //Guarda tu coleccion
            $user->save();
            return redirect()->route('users.verMiBiblioteca')->with("borradocoleccion", "Has eliminado un videojuego de tu colección");
        }
    }

    public function   eliminarTodaBiblioteca(User $user){
        $user->coleccion = null;
            //Guarda tu coleccion
            $user->save();
            return redirect()->route('users.verMiBiblioteca')->with("borradotodacoleccion", "Has eliminado todos los videojuego de tu colección");
        
    }
  


    public function perfil()
    {
        //Te identifica y te redirige a la vista de tu perfil
        $user = auth()->user();
        return view('user.perfil', ['user' => $user]);
    }

    public function cambiarpassword()
    {
        //Te identifica y te redirige a la vista para cambiar la contraseña
        $user = auth()->user();
        return view('user.cambiarpassword', ['user' => $user]);
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
        //Modificar el perfil de otro usuario o el tu
        $user = Usuario::find($id);
        $password = $user->password;
        $request->validate([

            "name" => "required|max:30",
"apellido"=> "required|max:30",
            "imagenperfil" => "image|mimes:jpg,png,jpeg,svg|dimensions:min_width=100,min_heigh=100"

        ], [
            "name.required" => "El nombre es obligatorio",
            "name.max"=>"El nombre solo puede tener hasta 30 caracteres",
            "apellido.required" => "El apellido es obligatorio",
            "apellido.max"=>"El apellido solo puede tener hasta 30 caracteres",
            "imagenperfil.image" => "El archivo debe ser una imagen",
            "imagenperfil.mimes" => "La imagen debe tener extension jpg,jpeg,gif o svg",
            "imagenperfil.dimensions" => "La imagen debe tener unas dimensiones minimas de 100x100 px"
        ]);
        $user->name = $request->input('name');
        $user->apellido=$request->input('apellido');
        //Fija rutas en imagenesperfil
        $imagen = $request->file("imagenperfil");
        if ($imagen != null) {
            $nombreimagen = basename($_FILES["imagenperfil"]["name"]);
            $rutaimagen = $imagen->store("imagenesperfil");


            $rutaalternativa = "../public/imagenesperfil/";

            $rutacompleta = $rutaalternativa . $nombreimagen;
            $user->imagen = $rutaimagen;
        }
        //Salva ruta de imagen en bbdd
        $user->save();
        //Guarda la imagen en la

        if ($imagen != null) {
            $rutaimagen = $imagen->store("public/imagenesperfil");
            $rutaimagen = "/" . $rutaimagen;

            if (move_uploaded_file($_FILES['imagenperfil']['tmp_name'], $rutacompleta)) {

                if (rename($rutacompleta, "../" . $rutaimagen)) {
                    return redirect()->route('proyects.index')->with('usuarioeditado', 'Has actualizado tu usuario');
                }
            } else {
                dd("No conseguido");
            }
        }





        //En caso de que decidas no actualizar
        $user->save();
        return redirect()->route('proyects.index')->with("usuarioeditado", 'Has actualizado el perfil de usuario');
    }





    public function updateGeneral(Request $request, $id)
    {
        //Cambiar datos de perfil de otro usuario
        $user = Usuario::find($id);

        $request->validate([

            "name" => "required",
            "apellido"=> "required",


        ], [
            "name.required" => "El nombre es obligatorio",
            "apellido.required" => "El apellido es obligatorio"
        ]);

        //Cambiar nombre
        $user->name = $request->input('name');

        //Cambiar apellido
        $user->apellido = $request->input('apellido');
        //Cambiar rol (usuario/administrador)
        $user->rol = $request->input('rol');


        //Guarda el usuario
        $user->save();
        //Redirige al index de usuarios
        return redirect()->route('users.index')->with("usuariogeneraleditado", 'Has actualizado el perfil de un usuario');
    }



    public function formcambiarpassword(Request $request, $id)
    {
        //Cambia contraseña de tu usuario
        $user = Usuario::find($id);
        //Vamos a comparar entre la nueva contraseña y la actual. 
        //1. Tiene que se diferente a la contraseña actual
        //2. La contraseña nueva y su confirmacion deben ser exactamente iguales
        $password = $user->password;
        $request->validate([

            "nuevapassword" => ["required", "string", "min:8", function ($attribute, $value, $fail) use ($request) {
                $password = Usuario::find($request->user()->id)->password;
                if (password_verify($request->input('nuevapassword'), $password)) {
                    $fail("La nueva contraseña no puede ser la misma a la actual");
                }
            }],

            "repitenuevapassword" => "required|same:nuevapassword"


        ], [
            "password.same" => "Contraseña actual incorrecta",
            "repitenuevapassword.same" => "Repite la nueva contraseña correctamente",
            "nuevapassword.min" => "La nueva contraseña debe tener al menos 8 caracteres",
            "nuevapassword.string" => "La nueva contraseña debe ser una cadena"




        ]);


        if (password_verify($request->input('nuevapassword'), $password)) {
        } else {
        }
        $user->password = Hash::make($request['nuevapassword']);


        //Guarda la nueva contraseña

        $user->save();
        return redirect()->route('proyects.index')->with('contraseñaactualizada', 'Has cambiado tu contraseña');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //Para eliminar un usuario debes activar el check al lado del boton de eliminar (borrar usuarios se debe tratar con cuidado)
        if ($request->input("checkeliminar") == 1) {
            $user = User::find($id);
            $user->delete();
            //Elimina al usuario y te avisa del exito
            return redirect()->route('users.index')->with("usereliminado", "Usuario eliminado exitosamente");
        } else {
            //No te elimina al usuario y te recuerda que para eliminar usuarios debes activar el check
            return redirect()->route('users.index')->with("errorborrarusuario", "Para eliminar a un usuario debes seleccionar el check ");
        }



    }
}
