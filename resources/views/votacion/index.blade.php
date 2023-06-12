@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!--Solo puedes acceder a esta vista si eres un administrador-->

            <!--Mensajes de alerta-->
            @if($message = Session::get('votacioncreada'))
            <script>
                iziToast.success({
                    title: 'Operación exitosa',
                    message: '{{$message}}',
                });
            </script>
            @endif
            @if($message = Session::get('votacioneliminada'))
            <script>
                iziToast.success({
                    title: 'Operación exitosa',
                    message: '{{$message}}',
                });
            </script>
            @endif

            <!--Lista de votaciones-->
            <h1 style="background-color: white !important; text-align: center; border: 2px solid grey " class="bordesredondeados">Gestión de votaciones</h1>

            @if(auth()->user()->can('permisosAdmin',['App\Models\User',auth()->user()]))
            <!--Boton crear votacion-->
            <a class="btn btn-success" href="{{ route('votaciones.create') }}" class="btn btn">Nueva votacion</a>
            @endif

            <!--Si la lista de votaciones esta vacia muestra un panel de alerta-->
            @if($votacionesList==null || $votacionesList=='[]')

            <div id="contenedorsinelementos">


                <div class="alert alert-warning" role="alert">
                    <h2>Vaya, parece que actualmente no hay votaciones</h2>
                </div>
                <img src="{{asset('imagenes/resenyasnoencontradas.png')}}" class="img-responsive" width="200px" height="200px" style="margin-left:33%" />
            </div>
            @else

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
                        <form action="{{route('votaciones.destroy',$votacion->id)}}" method="post" class="formularioeliminarvotacion">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><span class="fa fa-trash"></span>&nbsp;</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            @endif
        </div>
    </div>
</div>
@endsection