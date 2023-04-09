
$(document).ready(function (){


    $('#ordenarpor').click(function(ev) {
alert("aaa");
    });

$('.ordenarpor').click(function(ev) {
ev.preventDefault();
let orden = $(this).data('ordenar');

$.ajax({
url: 'route(proyects.index)',
type: 'GET',
data: {orden: orden},
success: function(data){
 $('#contenedorGames').html(data);   
}

});


});
});