@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!--Solo puedes acceder a esta vista si eres un administrador-->

            <!--Mensajes de alerta-->
            @if($message = Session::get('votacioncreada'))
            <div class="alert alert-success">
                <h4>{{$message}}</h4>
            </div>
            @endif
            @if($message = Session::get('votacioneliminada'))
            <div class="alert alert-success">
                <h4>{{$message}}</h4>
            </div>
            @endif

            <!--Lista de votaciones-->
            <h1 style="background-color: white !important; text-align: center" class="bordesredondeados">Lista votaciones</h1>

            @if(auth()->user()->can('permisosAdmin',['App\Models\User',auth()->user()]))
            <!--Boton crear votacion-->
            <a class="btn btn-success" href="{{ route('votaciones.create') }}" class="btn btn">Nueva votacion</a>
            @endif
            <!--Tabla de votaciones-->
            <table class="table table-striped table-hover" id="tablavotaciones">
                <tr>
                    <td>id</td>
                    <td>nombre</td>

                    <td>descripcion</td>
                    <td>Opción 1</td>
                    <td>Opción 2</td>
                    <td>participantes</td>
                </tr>
                <!--Recorre las votaciones-->
                @foreach($votacionesList as $votacion)

                <tr>
                    <!--Id de la votacion -->
                    <td>{{$votacion->id}}</td>
                    <!--Nombre de la votacion -->
                    <td>{{$votacion->nombre}}</td>
                    <!--Descripcion de la votacion -->
                    <td style="max-width: 300px;overflow-wrap:break-word !important;">{{$votacion->descripcion}}</td>
                    <!--Nombre de la primera opcion -->
                    <td>{{$votacion->nombreopcion1}}</td>
                    <!--Nombre de la segunda opcion -->
                    <td>{{$votacion->nombreopcion2}}</td>
                    <!--Participante de la votacion, ira por sus ids para que no haya confusiones-->
                    <td>{{$votacion->participantes}}</td>

                    <!--Si la votacion esta activa se mostrará en el index, no es lo mismo que eliminar, si esta desactivada/activa se podrá recurrir en cualquier momento -->
                    @if($votacion->activo==1)
                    <td>
                        <form action="{{route('votaciones.cerrarvotacion',$votacion->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" value="Cerrar votacion" class="btn btn-transparent"><span class="fa fa-toggle-on fa-2x"></span>&nbsp;</button>
                        </form>
                    </td>
                    <!--Por el contrario si está cerrada no se podrá ver-->
                    @else

                    <td>
                        <form action="{{route('votaciones.activarvotacion',$votacion->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" value="activar votacion" class="btn btn-transparent"><span class="fa fa-toggle-off fa-2x"></span>&nbsp;</button>
                        </form>
                    </td>
                    @endif
                    <td>
                        <!--Botom eliminar votacion-->
                        <form action="{{route('votaciones.destroy',$votacion->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><span class="fa fa-trash"></span>&nbsp;</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>

        </div>
    </div>
</div>
@endsection