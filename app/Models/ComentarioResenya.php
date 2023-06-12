<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioResenya extends Model
{
    //Modelo de los comentarios de las reseñas

    use HasFactory;
    protected $table = "comentariosresenyas";
    protected $fillable = ['user_id', 'resenya_id', 'comentario_id', 'contenido'];


    //Cada comentario pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    //Hijos del comentario (respuestas)
    public function hijos()
    {
        return $this->hasMany(ComentarioResenya::class, "padre_id");
    }
    //Padre del comentario
    public function padre()
    {
        return $this->belongsTo(ComentarioResenya::class, "padre_id");
    }
}
