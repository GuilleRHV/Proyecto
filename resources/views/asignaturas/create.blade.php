@extends('layouts.master');

@section('title','Alta asignaturas')

@section('encabezado')
    Alta de Asignaturas
@stop


@section('cuerpo')
    @parent
    <h3>Completa el siguiente formulario</h3>
    <form action="{{ route('asignaturas.store') }}" method="post">
<label for="nombre">Nombre</label><br>
<input type="text" name="nombre" id="nombre">
<br>
<label for="curso">Curso</label><br>
<input type="text" name="curso" id="curso">
<br>
<label for="ciclo">Ciclo</label><br>
<input type="text" name="ciclo" id="ciclo"><br>
<label for="coment">Comentarios</label><br>
<textarea name="comentario" id="comentarios" cols="24" rows="10" placeholder="Escribe aqui"></textarea>
<br>
@stop


@section('boton')
    @parent
    @section('destino')
        {{route('asignaturas.store')}}
    @stop

    @section('accionformulario')
    Enviar 
    @stop
</form>
@stop


