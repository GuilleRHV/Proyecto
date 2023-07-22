<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\GameMail;
class MailController extends Controller
{
    
    public function index(){
        $mailData=[
            'title'=>'Prueba email',
            'body'=>'este es un testeo'
        ];
        Mail::to('pruebaproyectoestetica1@gmail.com')->send(new GameMail($mailData));
        
    }
}
