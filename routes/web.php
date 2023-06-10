<?php

use App\Http\Controllers\AppEjemplos;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudyController;

use App\Http\Controllers\PruebaController;
use Illuminate\Database\Console\PruneCommand;

use App\Http\Controllers\AppEjemplo;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\VideoclubController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ComentarioResenyaController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProyectController;
use App\Http\Controllers\ResenyaController;
use App\Http\Controllers\VotacionController;
use App\Models\ComentarioResenya;
use App\Models\Game;
use App\Models\Usuario;
use App\Models\Votacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


///////////////////////////////////////////////////////////////////////////////////////////////////////////////


Route::get('/', function () {
    $user = Auth::user();
    $gameList=Game::paginate(10);   
            $votacionesList=Votacion::all();
            return view('proyect.index', ['gameList' => $gameList,'user'=>$user,'votacionesList'=>$votacionesList,'query'=>null,'resultados'=>null]);
});
//PROYECTO

Route::get('/buscar', 'App\Http\Controllers\GameController@buscar')->name('buscar');
//users.verMiBiblioteca
Route::post('/proyectsordprecio',[ProyectController::class,'indexordprecio'])->name('proyects.indexordprecio');
Route::get('/proyects/votacionesGeneral',[VotacionController::class,'votacionesGeneral'])->name('votacion.votacionesGeneral');

Route::put('/proyects/activarvotacion/{id}',[VotacionController::class,'activarvotacion'])->name('votaciones.activarvotacion');
Route::put('/proyects/cerrarvotacion/{id}',[VotacionController::class,'cerrarvotacion'])->name('votaciones.cerrarvotacion');
Route::put('/proyects/updateGeneral/{id}',[UserController::class,'updateGeneral'])->name('users.updateGeneral');
Route::get('/proyects/perfil',[UserController::class,'perfil'])->name('users.perfil');
Route::get('/proyects/cambiarpassword',[UserController::class,'cambiarpassword'])->name('users.cambiarpassword');
Route::put('/proyects/formcambiarpassword/{id}',[UserController::class,'formcambiarpassword'])->name('users.formcambiarpassword');
Route::get('/proyects/{user}',[UserController::class,'verMiBiblioteca'])->name('users.verMiBiblioteca');
Route::post('/proyects/{user}/{game}',[GameController::class,'agregarAColeccion'])->name('games.agregarAColeccion');
Route::post('/proyects/{orden}',[ProyectController::class,'indexNombre'])->name('proyects.indexNombre');
Route::post('/proyects/games/{game_id}/{user_id}',[ComentarioController::class,'store'])->name('comentarios.store');
Route::post('/proyects/games/{game_id}/{user_id}/{comentario}',[ComentarioController::class,'responder'])->name('comentarios.responder');

Route::post('/proyects/resenyas/{resenya_id}/{user_id}',[ComentarioResenyaController::class,'store'])->name('comentariosresenyas.store');
Route::post('/proyects/resenyas/{resenya_id}/{user_id}/{comentario}',[ComentarioResenyaController::class,'responder'])->name('comentariosresenyas.responder');

Route::get('/proyects/verMiBiblioteca',[UserController::class,'verMiBiblioteca'])->name('users.verMiBiblioteca');
Route::delete('/proyects/verMiBiblioteca/{user}/{game}',[UserController::class,'eliminarDeMiBiblioteca'])->name('users.eliminarDeMiBiblioteca');




Route::resource('proyects', ProyectController::class);

Route::resource('games', GameController::class);

Route::resource('resenyas', ResenyaController::class);

Route::resource('votaciones', VotacionController::class);
Route::delete('/proyects/games/{comentario_id}/destroy', [ComentarioController::class, "destroy"])->name('comentarios.destroy');
Route::delete('/proyects/games/{comentario_id}/destroycomentarioresenya', [ComentarioResenyaController::class, "destroy"])->name('comentariosresenyas.destroy');
//Route::resource('comentarios', ComentarioController::class);
//Route::resource('comentarios', ComentarioController::class);



/*********************************** */
//Route::resource('comentarios', ComentarioController::class);
Route::resource('orders', OrderController::class);

Route::resource('products', ProductController::class);


Route::resource('clients', ClientController::class);

Route::resource('users', UserController::class);




//AJAX***********************************************************
Route::get('/productos/html', [ProductoController::class, "indexhtml"]);
Route::get('/productos/json', [ProductoController::class, "indexjson"]);
Route::resource('productos', ProductoController::class);
/****************************************************** */

/*EJERCICIO VIDEOCLUB*/

/*
Route::get('/',[HomeController::class,'gethome']);
Route::get('/catalog',[CatalogController::class,'getIndex']);
Route::get('/catalog/create',[CatalogController::class,'getCreate']);
Route::get('/catalog/{id}/edit',[CatalogController::class,'getEdit']);
*/

//Route::get('/',[CatalogController::class,'home']);

//Route::resource('/', CatalogController::class);





/*
Route::get('/videoclub',[VideoclubController::class,'index']);
Route::get('/videoclub/login',[VideoclubController::class,'login']);
Route::get('/videoclub/create',[VideoclubController::class,'create']);
Route::post('/videoclub',[VideoclubController::class,'store']);
*/


Route::get('/hola', function () {
    echo "Hola mundo.";
    $arr = [1, 2, 3, "hola"];
    //dd($_SERVER);
    // dd($arr);
    //Return devuelve en json
    return $_SERVER;
    dd($_SERVER);
});

Route::get('/hola/{nombre}', function ($nombre) {
    echo "Hola $nombre.";
});
//Si no me llega parametro el nombre es mundo
Route::get('/saludo/{nombre?}', function ($nombre = "Mundo") {
    echo "Hola $nombre.";
});
/*
Route::get('/studies', [StudyController::class, "index"]);

Route::get('/studies/create', [StudyController::class, "create"]);

Route::get('/studies/{id}', [StudyController::class, "show"]);

Route::get('/studies/{id}/edit', [StudyController::class, "edit"]);

Route::delete('/studies/{id}/destroy', [StudyController::class, "destroy"]);

Route::put('/studies/{id}', [StudyController::class, "uptade"]);

Route::post('/studies', [StudyController::class, "store"]);

*/

Route::get('/studies/{id}', function ($id) {
    echo "Show del id " . $id;
    //}) -> where ("id","[0-9]+");
})->where("id", "[0-9]+[a-zA-Z]+");



Route::get('/prueba2/{name}', [PruebaController::class, "saludoCompleto"]);
//Route::resource('/studies', [StudyController::class]);

//RUTAS CON NOMBRE
Route::get('/contacta-con-ies', function () {
    return "dinos tu duda";
})->name("contacto");

/*Route::get('/',function(){
    echo "<a href='".route("contacto")."'>Contactar 1</a><br>";
    echo "<a href='contacta-con-ies'>Contactar 2</a><br>";
    echo "<a href='contacta-con-ies'>Contactar 3</a><br>";

});*/

//---------------------------------------------
Route::get('/informacion-asignatura', [AppEjemplo::class, 'mostrarinformacion'])->name("infoasig");

/*Route::get('/', function () {
    echo "<a href='" . route("infoasig") . "'>Mostrar informacion Asignatura</a><br>";
});
*/
/******************************************** */
Route::resource('/asignaturas', AsignaturaController::class);
//Es lo mismo que 
/* Route::get('/asignaturas/create', [AsignaturaController::class,'create']);
        Route::post('/asignaturas', [AsignaturaController::class,'store']);
        Route::put('/asignaturas', [AsignaturaController::class,'update']);
        ...
    */


///////////////////////////////////////////////////////////////////////////////////////////////////////////////

/*EJERCICIO VIDEOCLUB*/

//Route::get('/',[VideoclubController::class,'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

