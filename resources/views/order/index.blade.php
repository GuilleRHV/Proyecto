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

            




            <h1>Lista productos</h1>

            <a class="btn btn-success" href="{{ route('products.create') }}" class="btn btn">Nuevo producto</a>
          
            <table class="table table-striped table-hover">
                @foreach($orderList as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->nombre}}</td>
                    <td>{{$order->descripcion}}</td>
                    <td>{{$order->precio}}</td>
                    <td>
                        @can ('update', $order)
                        <a class="btn btn-warning" href="{{route('products.edit',$order->id)}}">Editar</a>
                        @endcan
                    </td>
                    <td>
                        @can ('view', $order)
                        <a class="btn btn-primary" href="{{route('products.show',$order->id)}}">Ver</a>
                        @else
                        @endcan
                    </td>
                    <td>
                        @can ('delete', $order)
                        <form action="{{route('products.destroy',$order->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Borrar" class="btn btn-danger">
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