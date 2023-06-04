
function votar(id){
  

    var numId = id.split("votar");
    //console.log(numId[1]);
    var numero = numId[1];
    window.open("votaciones/"+numero+"/edit","ventanaEmergente","width=300px,height=300px");
}

function escondercomentarios(valor,esconder) {


//alert(esconder);
    let separador = valor.split("padre")
    let id = separador[1];
    let subcomentarios = document.getElementsByClassName("subcomentarios"+id);

    let botonesconder = document.getElementById(esconder);
  /*  
    
    for(let i = 0; i <subcomentarios.length; i++) {
        if(subcomentarios[i].style.display == 'none'){
            subcomentarios[i].style.display = 'block';
            botonesconder.innerHTML = "Ocultar respuestas";
        }else{
            subcomentarios[i].style.display = 'none';
            botonesconder.innerHTML = "Mostrar respuestas";
        }
    }
*/
  

if($(".subcomentarios"+id).css("display")=="none"){
    $(".subcomentarios"+id).addClass('inactivo');
}



  //  $("#"+esconder).on('click', function () {

      //  console.log(esconder);
      //  console.log(subcomentarios);
       
        if ($(".subcomentarios"+id).hasClass('inactivo')) {
            $(".subcomentarios"+id).css({

                'display': 'block'


            });
           
            $(".subcomentarios"+id).addClass('slide-in-fwd-center');
            $(".subcomentarios"+id).removeClass('inactivo');    
            botonesconder.innerHTML = "Ocultar respuestas <span class='fa fa-sort-desc'></span>&nbsp;";
        }else{
            $(".subcomentarios"+id).addClass('slide-out-bck-center').delay(700).queue(function(next){
                $(".subcomentarios"+id).css({

                    'display': 'none'
    
    
                });
                $(".subcomentarios"+id).removeClass('inactivo');
                $(".subcomentarios"+id).removeClass('slide-out-bck-center');
                next();
                    
                $(".subcomentarios"+id+" span").removeClass("fa-sort-desc");
                $(".subcomentarios"+id+" span").addClass("fa-caret-right");
                botonesconder.innerHTML = "Mostrar respuestas <span class='fa fa-sort-desc'></span>&nbsp;";

            
           
        });
    }


  //  });
    
 
}


/*
function escondercomentarios() {
    
   let botones= document.getElementsByClassName("boton");
   let todos = document.target.id;
   window.alert(todos.id);
    let idboton = botones.target.id;
    window.alert("has clicado");
        window.alert(idboton);
         

}*/