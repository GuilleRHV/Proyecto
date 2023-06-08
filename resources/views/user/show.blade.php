@extends('layouts.app')

@section('content')
<div class="container" style="background-color: white">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>Detalles del usuario</h1>




            <!--Nombre del usuario -->
            <div class="form-group">
                <label for="nombre" class="col-form-label" style="font-weight:600;font-size:17px">Nombre</label><br>
                <label for="nombre" class="col-form-label">{{ $user->name ?? '' }}</label>
            </div>
            <!--Apellido del usuario -->
            <div class="form-group">
                <label for="nombre" class="col-form-label" style="font-weight:600;font-size:17px">Apellido</label><br>
                <label for="nombre" class="col-form-label">{{ $user->apellido ?? '' }}</label>
            </div>
            <!--Email del usuario -->
            <div class="form-group">
                <label for="email" class="col-form-label" style="font-weight:600;font-size:17px">email</label><br>
                <label for="email" class="col-form-label">{{ $user->email ?? '' }}</label>
            </div>
            <!--Rol del usuario -->
            <div class="form-group">
                <label for="rol" class="col-form-label" style="font-weight:600;font-size:17px">rol</label><br>
                <label for="rol" class="col-form-label">{{ $user->rol ?? '' }}</label>
            </div>


            <!--Boton ir al index de usuarios -->
            <a href="{{route('users.index')}}" class="btn btn-primary">Index usuarios</a>
            <!--Boton editar este usuario -->
            <a href="{{route('users.edit',$user->id)}}" class="btn btn-warning">Edit</a>






        </div>
    </div>
</div>
@endsection