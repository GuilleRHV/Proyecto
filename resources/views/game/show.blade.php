@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>Detalle del videojuego</h1>
            
            
               
           

            

                    <div class="form-group">
                    <label for="nombre" class="col-form-label" style="font-weight:600;font-size:17px">Nombre</label><br>
                    <label for="nombre" class="col-form-label">{{ $game->nombre ?? '' }}</label>
                    </div>

                    <div class="form-group">
                    <label for="descripcion" class="col-form-label" style="font-weight:600;font-size:17px">Descripcion</label><br>
                    <label for="descripcion" class="col-form-label">{{ $game->descripcion ?? '' }}</label>
                    </div>

                    <div class="form-group">
                    <label for="precio" class="col-form-label" style="font-weight:600;font-size:17px">plataforma</label><br>
                    <label for="precio" class="col-form-label">{{ $game->plataforma ?? '' }}</label>
                    </div>

                    <div class="form-group">
                    <label for="precio" class="col-form-label" style="font-weight:600;font-size:17px">año de lanzamiento</label><br>
                    <label for="precio" class="col-form-label">{{ $game->anyo ?? '' }}</label>
                    </div>

                        
                    
                    <a href="{{route('games.index')}}" class="btn btn-primary">Index</a>
                    <a href="{{route('games.edit',$game->id)}}" class="btn btn-warning">Edit</a>
          

              
                
            

        </div>
    </div>
</div>
@endsection