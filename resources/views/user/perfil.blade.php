@extends('layouts.app')

@section('content')
<div class="container" style="background-color: white; height: 700px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
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

            <form action="{{route('users.update',$user->id)}}" method="post">
@csrf
@method("PUT")
            <h1>{{$user->name}}</h1>
          
            <div class="form-group">
                <label for="nombre" class="col-form-label" style="font-weight:600;font-size:17px">Nombre</label><br>
     <input type="text" class="form-control" name="name" value="{{ $user->name ?? '' }}"/>
            </div>
            <hr>
            <div class="form-group">
                <label for="" class="col-form-label" style="font-weight:600;font-size:17px">Email</label><br>
                <label for="" class="col-form-label">{{ $user->email ?? '' }}</label>
            </div>
            <hr>
            <div class="form-group" id="cambiarcontraseña" style="display:none ;">
            <br><label for="edad" class="col-form-label" style="font-weight:600;font-size:17px">Contraseña actual</label><br>
                <label for="edad" class="col-form-label">{{ $user->password ?? '' }}</label>

                <br><label for="edad" class="col-form-label" style="font-weight:600;font-size:17px">Nueva contraseña</label><br>
                <label for="edad" class="col-form-label">{{ $user->nuevapassword ?? '' }}</label>
                <input type="password" class="form-control" name="nuevapassword"/>
                <br> <label for="edad" class="col-form-label" style="font-weight:600;font-size:17px">Repite nueva contraseña</label><br>
                <input type="password" class="form-control" name="repitenuevapassword"/>
            </div>





        
            <input type="submit" class="btn btn-success" value="modificar perfil">
          
            

            </form>
            <a class="btn btn-warning" href="{{ route('users.cambiarpassword') }}" class="btn btn" >Cambiar contraseña</a>

          <!--  <table class="table table-striped table-hover">
                <tr>
                    <td>id</td>
                    <td>nombre</td>

                    <td>email</td>
                    <td>rol</td>
                </tr>
                
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->nombre}}</td>

                    <td>{{$user->email}}</td>
                    <td>{{$user->rol}}</td>
                   

                </tr>
           
            </table>-->

        </div>
    </div>
</div>
@endsection