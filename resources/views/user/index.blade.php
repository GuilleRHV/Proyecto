@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!--Mensajes alertas-->

            @if($message = Session::get('usereliminado'))
            <script>
                iziToast.success({
                    title: 'Operación exitosa',
                    message: '{{$message}}',
                });
            </script>
            @endif
            @if($message = Session::get('errorborrarusuario'))
            <script>
                iziToast.warning({
                    title: 'Error al borrar',
                    message: '{{$message}}',
                });
            </script>

            @endif
            @if($message = Session::get('usuariogeneraleditado'))
            <script>
                iziToast.info({
                    title: 'Edición exitosa',
                    message: '{{$message}}',
                });
            </script>
            @endif

            <h1 style="background-color: white;text-align: center; border: 2px solid grey" class="bordesredondeados"> Gestión de usuarios</h1>

            <!--Tabla de gestion de usuarios-->
            <table class="table table-striped table-hover" id="tablaeditusuarios">
                <tr>

                    <td class="tdname"><strong>nombre</strong></td>

                    <td><strong>email</strong></td>
                    <td class="tdrol"><strong>rol</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @foreach($userList as $user)

                <tr>
                    <!--Nombre usuario-->
                    <td class="tdname">{{$user->name}}</td>
                    <!--Email usuario-->
                    <td>{{$user->email}}</td>
                    <!--rol usuario-->
                    <td class="tdrol">{{$user->rol}}</td>
                    <td>
                        <!--boton editar usuario-->
                        @can ('update', $user)
                        <a class="btn btn-warning jello-horizontal" href="{{route('users.edit',$user->id)}}"><span class="fa fa-pencil jello-horizontal"></span>&nbsp;</a>
                        @endcan
                    </td>
                    <td>
                        <!--boton mostrar usuario-->
                        @can ('view', $user)
                        <a class="btn btn  jello-horizontal" href="{{route('users.show',$user->id)}}" style="background-color: #9AD3E6"><span class="fa fa-eye jello-horizontal"></span>&nbsp;</a>
                        @endcan
                    </td>
                    <td>
                        <!--Formulario eliminar usuario-->
                        @can ('create', $user)
                        <form action="{{route('users.destroy',$user->id)}}" method="post">
                            @csrf
                            @method('DELETE')

                            <!--Si no seleccionas el check de eliminar no podrás eliminar al usuario seleccionado y te saldrá una alerta-->
                            <input class="form-check-input jello-horizontal" type="checkbox" value="1" id="checkeliminar" name="checkeliminar">
                            <label class="form-check-label" for="flexCheckDefault">
                                Eliminar usuario
                            </label>


                            <!--Boton para eliminar usuario-->
                            <button type="submit" value="Delete" class="btn btn-danger jello-horizontal"><span class="fa fa-trash jello-horizontal"></span>&nbsp;</button>



                        </form>
                        @endcan
                    </td>

                </tr>
                @endforeach
            </table>

        </div>
    </div>
</div>
@endsection