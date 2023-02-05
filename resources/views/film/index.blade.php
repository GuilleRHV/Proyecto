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
            <a class="btn btn-success" href="{{ route('films.create') }}" class="btn btn">Nuevo juego</a>
           <!-- @endcan-->
            <table class="table table-striped table-hover table-dark">
                <tr>
                    <td>ID</td>
                    <td>NOMBRE</td>
                    <td>DESCRIPCION</td>
                    <td>GENERO</td>
                    <td>AÑO DE SALIDA</td>
                </tr>
                 @foreach($filmList as $film)
                <tr>
                    <td>{{$film->id}}</td>
                    <td>{{$film->nombre}}</td>
                    <td>{{$film->descripcion}}</td>
                    <td>{{$film->genero}}</td>
                    <td>{{$film->anyo}}</td>
                    <td>
                      
                        <a class="btn btn-warning" href="{{route('games.edit',$film->id)}}">Editar</a>
                     
                    </td>
                    <td>
                     
                        <a class="btn btn-primary" href="{{route('games.show',$film->id)}}">Ver</a>
                       
                    </td>
                    <td>
                       
                        <form action="{{route('games.destroy',$film->id)}}" method="post">
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