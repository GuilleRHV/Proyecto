<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $table = "comentarios";
    protected $fillable = ['user_id','juego_id','comentario_id','contenido'];


    public function usuario()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function hijos()
    {
        return $this->hasMany(Comentario::class, "padre_id");
    }

    public function padre()
    {
        return $this->belongsTo(Comentario::class, "padre_id");
    }
}
