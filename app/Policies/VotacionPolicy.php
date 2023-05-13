<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Votacion;
use Illuminate\Auth\Access\HandlesAuthorization;

class VotacionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function puedeVotacion(User $usuario,Votacion $votacion)
    {
        
        $user_id=$usuario->id;
        //$user_id = auth()->user()->id;

        $votacion =json_decode($votacion->participantes);
        if(!in_array($user_id,$votacion)){
            return false;
        }else{
            return true;
        }
        
    }
}
