document.addEventListener('DOMContentLoaded', function () {
        $(".votaciones").click(function(){
           // alert("Votacion");
            var id = $(this).attr("id");
           // console.log("id: "+id);
            
    
           
            var numId = id.split("votar");
            //console.log(numId[1]);
            var numero = numId[1];
                window.open("votaciones/"+numero+"/edit","ventanaEmergente","width=300px,height=300px",resizable=no);
         
    });





    $("#imagenjuegoshow").on('click', function () {

        $("#imagenjuegoshow").toggleClass('activo');

        if ($("#imagenjuegoshow").hasClass('activo')) {
            $("#imagenjuegoshow").css({

                'width': '70vh',
                'height': '70vh',

                'left': '22%',
                'margin-right': '200px !important',
                'z-index': 9999

            });
        }else{
            $("#imagenjuegoshow").css({

                'width': '30vh',
                'height': '30vh',

                'left': '35%',
                'margin-right': '200px !important',
                'z-index': 9999



            });
        }



    });


    


    $("#botoncambiarcontraseña").on('click', function () {

        $("#cambiarcontraseña").toggleClass('inactivo');

        if ($("#cambiarcontraseña").hasClass('inactivo')) {
            $("#cambiarcontraseña").css({

                'display': 'block'

            });
        }else{
            $("#cambiarcontraseña").css({

                'display': 'none'


            });
        }



    });



if





});