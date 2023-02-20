<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Attribute;
class Product extends Model
{
    use HasFactory;



    protected $fillable = ['nombre', 'descripcion', 'precio'];


    protected function Nombre(): Attribute
    {
        return new Attribute(
            fn ($value) => strtoupper($value),
            fn ($value) => ucfirst(strtolower($value)),
        );
    }

    //mutator -> set<nombre_atributo>Attribute -> direccion:: hacia la bbdd
    //accesor -> get
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = ucfirst(strtolower($value));
    }


    public function getNombreAttribute($value)
    {
        return strtoupper($value); //Devuelve el nombre en mayusculas
    }


    public function getPrecioAttribute($value)
    {
        return ($value . " euros"); //Devuelve el nombre en mayusculas
    }
}
