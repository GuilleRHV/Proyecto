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

    public function hijo()
    {
        return $this->belongsTo(Comentario::class, "comentario_id");
    }
}
