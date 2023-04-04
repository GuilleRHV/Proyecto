<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ["nombre","descripcion","anyoLanzamiento","generos","plataformas","precio","imagen"];
    protected $casts = ["generos"=>"array","plataformas"=>"array"];
    

    public function getProfilePictureAttribute($value){
        return base64_decode($value);
    }

    public function setProfilePictureAttribute(){
        return mime_content_type($this->attributes['imagenjuego']);
    }
}
