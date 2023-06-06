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

            <div id="contprincipalperfil">


                <form action="{{route('users.update',$user->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div id="imagenperfil">
                        @if($user->imagen==null)
                        <img src="{{asset('imagenesperfil/userdefault.png')}}" style="border-radius: 10% 10% 10% 10%;width:230px; height: 230px"/>

                        @else

                        <img src="../{{$user->imagen}}" style="width: 230px;height:230px; border-radius: 10% 10% 10% 10%;" />

                        @endif
                    </div>






                    <div id="datosperfil">
                        <br>
                        <h2 style="color: blue">{{$user->name}}</h2>



                        <div class="form-group">
                            <label for="nombre" class="col-form-label" style="font-weight:600;font-size:17px">Nombre</label><br>
                            <input type="text" class="form-control" name="name" value="{{ $user->name ?? '' }}" />
                        </div>
         
                        <div class="form-group">
                            <label for="" class="col-form-label" style="font-weight:600;font-size:17px">Email</label><br>
                            <label for="" class="col-form-label">{{ $user->email ?? '' }}</label>
                        </div>
                        <div class="mb-3">
                        <label for="nombre" class="col-form-label" style="font-weight:600;font-size:17px">Imagen de perfil</label><br>
  <input class="form-control" type="file"  name="imagenperfil">
</div>
                        <div class="form-group">
                           
                        </div>
                      
                      






<br>
                        <input type="submit" class="btn btn-success" value="modificar perfil">
                        <a class="btn btn-warning" href="{{ route('users.cambiarpassword') }}" class="btn btn">Cambiar contraseña</a>


                </form>
            </div>
        </div>
        

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