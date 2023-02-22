@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>Lista productos</h1>

            @can ('create', 'App\Models\Product')
            <a class="btn btn-success" href="{{ route('products.create') }}" class="btn btn">Nuevo producto</a>
            @endcan
            <div id="tablehtml">
                estoy aqui
            </div>


            <div id="tablejson">
                <table id="" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>descripcion</th>
                        </tr>
                        <tbody id="myTbody">
                            <tr>

                            </tr>
                        </tbody>
                    </thead>
                </table>
            </div>


        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        console.log("table");
        //loadDataHtml();
        loadDataJson();
    });
  /*  const loadDataHtml = function() {
        let url = "/productos/html";
        $.get(url, function(data, status) {
                $("#tablehtml").html(data);
            })
            .fail(function(e) {
                console.log("Error: " + e.status);
            });
    }*/



    const loadDataJson = function() {
        let url = "/productos/json";
        $.get(url, function(data, status) {
            console.log(data);
            $("#myTbody").empty();
            Object.keys(data).forEach(function(id){
                console.log(id);
                console.log(data[id]);
                var tr = document.createElement("tr");
                tr.setAttribute("id", `tr${data[id].id}`);
                let fila = "<td>"+data[id].nombre+"</td>";
                fila += "<td>"+data[id].descripcion +"</td>";
                fila += "<td>"+data[id].precio +"</td>";
                tr.innerHTML = fila;
                $("#myTbody").append(tr);

            });
           
            
    }).fail(function(e) {
                console.log("Error: " + e.status);
            });
}
</script>

@endsection