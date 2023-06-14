
//Funcion para votar (id=votacion_id)
function votar(id) {
    var numId = id.split("votar");
    var numero = numId[1];
    window.open("votaciones/" + numero + "/edit", "ventanaEmergente", "width=400px,height=400px");
}

//Para esconder los subcomentarios
function escondercomentarios(valor, esconder) {


    let separador = valor.split("padre")
    let id = separador[1];
    let subcomentarios = document.getElementsByClassName("subcomentarios" + id);

    let botonesconder = document.getElementById(esconder);



    if ($(".subcomentarios" + id).css("display") == "none") {
        $(".subcomentarios" + id).addClass('inactivo');
    }



    //Oculta/Muestra respuestas de los comentarios

    if ($(".subcomentarios" + id).hasClass('inactivo')) {
        $(".subcomentarios" + id).css({

            'display': 'block'


        });

        $(".subcomentarios" + id).addClass('slide-in-fwd-center');
        $(".subcomentarios" + id).removeClass('inactivo');
        botonesconder.innerHTML = "Ocultar respuestas <span class='fa fa-sort-desc'></span>&nbsp;";
    } else {
        $(".subcomentarios" + id).addClass('slide-out-bck-center').delay(700).queue(function (next) {
            $(".subcomentarios" + id).css({

                'display': 'none'


            });
            $(".subcomentarios" + id).removeClass('inactivo');
            $(".subcomentarios" + id).removeClass('slide-out-bck-center');
            next();

            $(".subcomentarios" + id + " span").removeClass("fa-sort-desc");
            $(".subcomentarios" + id + " span").addClass("fa-caret-right");
            botonesconder.innerHTML = "Mostrar respuestas <span class='fa fa-sort-desc'></span>&nbsp;";



        });
    }

}

