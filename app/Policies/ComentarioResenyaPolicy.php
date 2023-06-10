<?php

namespace App\Policies;

use App\Models\ComentarioResenya;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComentarioResenyaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ComentarioResenya  $comentarioResenya
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ComentarioResenya $comentarioResenya)
    {
        //
    }


    public function eliminarComentariosResenyas(User $user, ComentarioResenya $comentario)
    {
   
    
        $usercomentario = $comentario->user_id;
        if ($usercomentario == $user->id || $user->rol=="administrador") {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ComentarioResenya  $comentarioResenya
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ComentarioResenya $comentarioResenya)
    {
        //
    }
    public function escribirComentariosResenya( $user, $resenya){
        
        $comentarios = ComentarioResenya::all();
     
        $contador = 1;
        foreach( $comentarios as $comentario){
            if($comentario->user_id==$user->id && $comentario->resenya_id==$resenya->id){
                $contador++;
            }
        
        }
        if($contador >= 6){
            return false;
        }else{
            return true;
        }
        
    
     }
    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ComentarioResenya  $comentarioResenya
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ComentarioResenya $comentarioResenya)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ComentarioResenya  $comentarioResenya
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ComentarioResenya $comentarioResenya)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ComentarioResenya  $comentarioResenya
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ComentarioResenya $comentarioResenya)
    {
        //
    }
}
