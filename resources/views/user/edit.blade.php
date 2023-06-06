@extends('layouts.app')

@section('content')
<div class="container" style="background-color: white;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Modificar usuario</h1>
            <a href="{{route('users.index')}}" class="btn btn-primary">Index usuarios</a>

            <hr>
            <!--Errores formulario-->
            @if($errors->any())
            <div class="alert alert-danger">
                <h4>Por favor, corrige los siguientes errores:</h4>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}<br></li>
                    @endforeach
                </ul>
            </div>
            @endif


            <form action="{{route('users.updateGeneral',$user->id)}}" method="post">
                @csrf

                @method("PUT")
                <!--Nombre usuario-->
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name ?? '' }}">
                    </label>
                </div>
                <!--Email usuario-->
                <div class="form-group">
                    <label for="descripcion">Email</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ $user->email ?? '' }}">
                    </label>
                </div>
                <!--Rol del usuario(usuario o administrador)-->
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="rol" value="usuario" <?php
                                                                                            if ($user->rol == "usuario") {
                                                                                                echo 'checked';
                                                                                            }      ?>>
                    <label class="form-check-label" for="gerente">usuario</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="rol" value="administrador" <?php
                                                                                                    if ($user->rol == "administrador") {
                                                                                                        echo 'checked';
                                                                                                    }      ?>>
                    <label class="form-check-label" for="recepcionista">administrador</label>
                </div>
                <!--Boton actualizar usuario-->

                <input type="submit" value="Actualizar" class="btn btn-warning">
            </form>





        </div>
    </div>
</div>
@endsection