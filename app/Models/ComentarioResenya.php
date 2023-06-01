<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioResenya extends Model
{
    use HasFactory;
    protected $table = "comentariosresenyas";
    protected $fillable = ['user_id','resenya_id','comentario_id','contenido'];


    public function usuario()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function hijos()
    {
        return $this->hasMany(ComentarioResenya::class, "padre_id");
    }

    public function padre()
    {
        return $this->belongsTo(ComentarioResenya::class, "padre_id");
    }
}
