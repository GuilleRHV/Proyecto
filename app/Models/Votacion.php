<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votacion extends Model
{
    //Modelo de las votaciones
    use HasFactory;
    protected $table="votaciones";
    protected $fillable = ['nombre', 'descripcion','participantes', 'nombreopcion1', 'nombreopcion2',"valoropcion1","valoropcion2","activo"];
}
