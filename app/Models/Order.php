<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Order extends Model
{
    use HasFactory;

    public function clients(){
        //return $this->hasMany(Client::class); //Relacion 1:N
        return $this->belongsToMany(Client::class); //Relacion n:M
    }

//Fechas

//1 forma
    protected $casts = [
        "fecha"=>"datetime:d-m-Y",
    ];
//2 forma
  /*  public function Nombre(): Attribute
    {
        return new Attribute(
            fn ($value) => Carbon::parse($value)->format('d-m-Y'), //get
            fn ($value) => Carbon::parse($value)->format('d/m/Y'), //set
        );
    }
*/
    //protected $dateFormat = 'd-m-Y H:i:s';
}
