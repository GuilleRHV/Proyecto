<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    //Modelo de los comentarios de los videojuegos
    use HasFactory;
    protected $table = "comentarios";
    protected $fillable = ['user_id','juego_id','comentario_id','contenido'];


        //Cada comentario pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, "user_id");
    }
//Hijos del comentario(respuestas)
    public function hijos()
    {
        return $this->hasMany(Comentario::class, "padre_id");
    }
//Padre del comentario
    public function padre()
    {
        return $this->belongsTo(Comentario::class, "padre_id");
    }
}
