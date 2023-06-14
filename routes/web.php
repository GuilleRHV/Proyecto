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


//PROYECTO

//Indice del proyecto
Route::get('/', function () {
    $user = Auth::user();
    $gameList = Game::paginate(10);
    $votacionesList = Votacion::all();
    return view('proyect.index', ['gameList' => $gameList, 'user' => $user, 'votacionesList' => $votacionesList, 'query' => null, 'resultados' => null]);
});

Route::get('/buscar', 'App\Http\Controllers\GameController@buscar')->name('buscar');


//Index votaciones que pueden ver los usuarios normales
Route::get('/proyects/votacionesGeneral', [VotacionController::class, 'votacionesGeneral'])->name('votacion.votacionesGeneral');
//Activar/Cerrar votaciones
Route::put('/proyects/activarvotacion/{id}', [VotacionController::class, 'activarvotacion'])->name('votaciones.activarvotacion');
Route::put('/proyects/cerrarvotacion/{id}', [VotacionController::class, 'cerrarvotacion'])->name('votaciones.cerrarvotacion');
//Cambiar datos de perfil de otros usuario
Route::put('/proyects/updateGeneral/{id}', [UserController::class, 'updateGeneral'])->name('users.updateGeneral');
//Cambiar datos de tu perfil
Route::get('/proyects/perfil', [UserController::class, 'perfil'])->name('users.perfil');
//Cambiar contraseña
Route::get('/proyects/cambiarpassword', [UserController::class, 'cambiarpassword'])->name('users.cambiarpassword');
//Formulario para cambiar tu contraseña
Route::put('/proyects/formcambiarpassword/{id}', [UserController::class, 'formcambiarpassword'])->name('users.formcambiarpassword');
//Ver tu biblioteca de videojuegos personal
Route::get('/proyects/{user}', [UserController::class, 'verMiBiblioteca'])->name('users.verMiBiblioteca');
//Agregar un videojuego a tu coleccion
Route::post('/proyects/{user}/{game}', [GameController::class, 'agregarAColeccion'])->name('games.agregarAColeccion');
Route::post('/proyects/{orden}', [ProyectController::class, 'indexNombre'])->name('proyects.indexNombre');
//Crear un comentario en juegos
Route::post('/proyects/games/{game_id}/{user_id}', [ComentarioController::class, 'store'])->name('comentarios.store');
//Responder a un comentario en juegos
Route::post('/proyects/games/{game_id}/{user_id}/{comentario}', [ComentarioController::class, 'responder'])->name('comentarios.responder');
//Crear un comentario en reseñas
Route::post('/proyects/resenyas/{resenya_id}/{user_id}', [ComentarioResenyaController::class, 'store'])->name('comentariosresenyas.store');
//Responder a un comentario en reseñas
Route::post('/proyects/resenyas/{resenya_id}/{user_id}/{comentario}', [ComentarioResenyaController::class, 'responder'])->name('comentariosresenyas.responder');
//Ver mi biblioteca de juegos 
Route::get('/proyects/verMiBiblioteca', [UserController::class, 'verMiBiblioteca'])->name('users.verMiBiblioteca');
//Eliminar un juego de mi biblioteca personal
Route::delete('/proyects/verMiBiblioteca/{user}/{game}', [UserController::class, 'eliminarDeMiBiblioteca'])->name('users.eliminarDeMiBiblioteca');
//Eliminar todos tus juegos de tu biblioteca personal
Route::delete('/proyects/eliminarDeMiBiblioteca/{user}', [UserController::class, 'eliminarTodaBiblioteca'])->name('users.eliminarTodaBiblioteca');


//Resource de proyect
Route::resource('proyects', ProyectController::class);
//Resource de videojuegos
Route::resource('games', GameController::class);
//Resource de reseñas
Route::resource('resenyas', ResenyaController::class);
//Resource de votaciones
Route::resource('votaciones', VotacionController::class);
//Eliminar un comentario de juegos
Route::delete('/proyects/games/{comentario_id}/destroy', [ComentarioController::class, "destroy"])->name('comentarios.destroy');
//Eliminar un comentario de reseñas
Route::delete('/proyects/games/{comentario_id}/destroycomentarioresenya', [ComentarioResenyaController::class, "destroy"])->name('comentariosresenyas.destroy');

//Resource de usuarios
Route::resource('users', UserController::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
