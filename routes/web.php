<?php

use App\Http\Controllers\AppEjemplos;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudyController;

use App\Http\Controllers\PruebaController;
use Illuminate\Database\Console\PruneCommand;

use App\Http\Controllers\AppEjemplo;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola', function(){
    echo "Hola mundo.";
    $arr = [1,2,3,"hola"];
    //dd($_SERVER);
   // dd($arr);
    //Return devuelve en json
    return $_SERVER;
    dd($_SERVER);
});

Route::get('/hola/{nombre}', function($nombre){
    echo "Hola $nombre.";
});
//Si no me llega parametro el nombre es mundo
Route::get('/saludo/{nombre?}', function($nombre = "Mundo"){
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

Route::get('/studies/{id}', function ($id){
    echo "Show del id ". $id;
//}) -> where ("id","[0-9]+");
}) -> where ("id","[0-9]+[a-zA-Z]+");



Route::get('/prueba2/{name}', [PruebaController::class, "saludoCompleto"]);
//Route::resource('/studies', StudyController::class);

//RUTAS CON NOMBRE
Route::get('/contacta-con-ies',function(){
return "dinos tu duda";
})->name("contacto");

/*Route::get('/',function(){
    echo "<a href='".route("contacto")."'>Contactar 1</a><br>";
    echo "<a href='contacta-con-ies'>Contactar 2</a><br>";
    echo "<a href='contacta-con-ies'>Contactar 3</a><br>";

});*/

//---------------------------------------------
Route::get('/informacion-asignatura',[AppEjemplo::class,'mostrarinformacion'])->name("infoasig");

Route::get('/',function(){
    echo "<a href='".route("infoasig")."'>Mostrar informacion Asignatura</a><br>";
  
});