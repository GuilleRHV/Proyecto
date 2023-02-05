@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($message = Session::get('productocreado'))
            <div class="alert alert-success">
                <h4>{{$message}}</h4>
            </div>
            @endif



            {{ session(['contador'=>'1'])}}

            {{session('cont') }}


            <h1>Lista videojuegos</h1>

           <!-- @can ('create', 'App\Models\Game')-->
            <a class="btn btn-success" href="{{ route('games.create') }}" class="btn btn">Nuevo juego</a>
           <!-- @endcan-->
            <table class="table table-striped table-hover table-dark">
                <tr>
                    <td>ID</td>
                    <td>NOMBRE</td>
                    <td>DESCRIPCION</td>
                    <td>PLATAFORMA</td>
                    <td>AÑO DE SALIDA</td>
                </tr>
                 @foreach($gameList as $game)
                <tr>
                    <td>{{$game->id}}</td>
                    <td>{{$game->nombre}}</td>
                    <td>{{$game->descripcion}}</td>
                    <td>{{$game->plataforma}}</td>
                    <td>{{$game->anyo}}</td>
                    <td>
                      
                        <a class="btn btn-warning" href="{{route('games.edit',$game->id)}}">Editar</a>
                     
                    </td>
                    <td>
                     
                        <a class="btn btn-primary" href="{{route('games.show',$game->id)}}">Ver</a>
                       
                    </td>
                    <td>
                       
                        <form action="{{route('games.destroy',$game->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Borrar" class="btn btn-danger">
                        </form>
                       

                    </td>

                </tr>
                @endforeach
            </table>

        </div>
    </div>
</div>
@endsection