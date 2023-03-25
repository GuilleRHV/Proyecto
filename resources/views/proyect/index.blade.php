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






            <h1>Proyecto index</h1>

            <a class="btn btn-success" href="{{ route('proyects.create') }}" class="btn btn">Nuevo producto</a>

            <table class="table table-striped table-hover">
                <tr>
                    <td>NOMBRE</td>
                    <td>DESCRIPCION</td>
                    <td>AÑO DE LANZAMIENTO</td>
                    <td>GENEROS</td>
                    <td>PLATAFORMAS</td>
                </tr>
                @foreach($gameList as $game)
                <tr>

                    <td>{{$game->nombre}}</td>
                    <td>{{$game->descripcion}}</td>
                    <td>{{$game->anyoLanzamiento}}</td>
                    <td>
                        @foreach($game->generos as $gen)
                        {{$gen}}
                        @endforeach
                    </td>
                    <td>
                        @foreach($game->plataformas as $gen1)
                        {{$gen1}}
                        @endforeach
                    </td>


                </tr>
                @endforeach
            </table>

        </div>
    </div>
</div>
@endsection