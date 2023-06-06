@extends('layouts.app')

@section('content')
<div class="container" style="background-color: white; height: 700px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
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

            <!--Formualrio cambio de contraseña-->
            <form action="{{route('users.formcambiarpassword',$user->id)}}" method="post">
                @csrf
                @method("PUT")
                <!--Nombre usuario-->
                <h1>{{$user->name}}</h1>

                <!--Si pones la misma contraseña que la actual te saltará una alerta-->
                <div class="form-group" id="cambiarcontraseña">

                    <!--Nueva contraseña-->
                    <br><label for="edad" class="col-form-label" style="font-weight:600;font-size:17px">Nueva contraseña</label><br>
                    <label for="edad" class="col-form-label">{{ $user->nuevapassword ?? '' }}</label>
                    <input type="password" class="form-control" name="nuevapassword" />
                    <!--Repetir la nueva contraseña-->
                    <br> <label for="edad" class="col-form-label" style="font-weight:600;font-size:17px">Repite nueva contraseña</label><br>
                    <input type="password" class="form-control" name="repitenuevapassword" />
                </div>





                <!--Boton editar contraseña del usuario-->
                <input type="submit" class="btn btn-success" value="modificar contraseña" style=" margin-top: 15px">


            </form>
            <!--Boton ir a mi perfil-->
            <a class="btn btn-warning" href="{{ route('users.perfil') }}" class="btn btn">Mi perfil</a>
            <hr>


        </div>
    </div>
</div>
@endsection