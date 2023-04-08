<?php

namespace App\Policies;

use App\Models\User;

use App\Models\Game;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComentarioPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */



    public function viewComentario(User $user, Game $game)
    {
        
    }

    public function escribirComentarios(User $user){
       return true;
    }
}
