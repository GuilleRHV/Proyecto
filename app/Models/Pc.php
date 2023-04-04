<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pc extends Model
{
    use HasFactory;
    protected $fillable = ["nombre", "descipcion", "anyoLanzamiento", "generos"];

    public function tratamientos(){
        return $this->belongsToMany(Tratamiento::class)->withPivot("fecha"); //Relacion 1:N
      
    }
}
