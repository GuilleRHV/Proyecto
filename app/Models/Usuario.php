<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //Se usará complementariamente con User
    //Modelo para los usuarios de la aplicacion
    use HasFactory;
    protected $table = "usuarios";
    protected $fillable = ['name','apellido','email','password','rol','coleccion'];
}