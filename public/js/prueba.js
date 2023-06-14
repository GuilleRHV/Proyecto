
document.addEventListener('DOMContentLoaded', function () {

    //Animacion carrousel
    var docWidth = $('body').width(),
        $wrap = $('#wrap'),
        $images = $('#wrap .hb'),
        slidesWidth = $wrap.width();


    $("#wrap").mousemove(function (e) {
        var mouseX = e.pageX,
            offset = mouseX / docWidth * slidesWidth - mouseX / 12;

        $images.css({
            '-webkit-transform': 'translate3d(' + -offset + 'px,0,0)',
            'transform': 'translate3d(' + -offset + 'px,0,0)'
        });
    });

    //fin animacion
    //Eliminar toda mi coleccion
    $(".formeliminartodacoleccion").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Estás seguro de querer eliminar toda tu coleccion?',
            text: 'Podrás volver estos juegos en tu colección más adelante',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sí, borrar'
        }).then((result) => {

            if (result.value) {

                setTimeout(this.submit(), 3000);

            }

        });
    });


    //Eliminar votacion confirmacion
    $(".formularioeliminarvotacion").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Estás seguro de querer eliminar esta votación?',
            text: 'Se borrarán todos los votos',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sí, borrar'
        }).then((result) => {

            if (result.value) {

                setTimeout(this.submit(), 3000);

            }

        });
    });
    //Eliminar juego de coleccion confirmacion

    $(".formeliminarcoleccion").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Estás seguro de querer eliminar este juego de tu colección?',
            text: 'Podrás volver a agregar este juego en tu colección más adelante',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sí, borrar'
        }).then((result) => {

            if (result.value) {

                setTimeout(this.submit(), 3000);

            }

        });
    });

    //Eliminar comentario de reseña confirmacion
    $(".formularioeliminarcomentarioresenya").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Estás seguro de querer eliminar este comentario?',
            text: 'Podrás volver a comentar en esta reseña',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sí, borrar'
        }).then((result) => {

            if (result.value) {

                setTimeout(this.submit(), 3000);

            }

        });
    });

    //Eliminar respuesta confirmacion
    $(".formularioeliminarrespuesta").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Estás seguro de querer eliminar esta respuesta?',
            text: 'Podrás volver a comentar en esta comentario',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sí, borrar'
        }).then((result) => {

            if (result.value) {

                setTimeout(this.submit(), 3000);

            }

        });
    });







    //Eliminar comentario juego confirmacion

    $(".formularioeliminarcomentariojuego").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Estás seguro de querer eliminar este comentario?',
            text: 'Podrás volver a comentar en este videojuego',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sí, borrar'
        }).then((result) => {

            if (result.value) {

                setTimeout(this.submit(), 3000);

            }

        });
    });





    //Eliminar juego confirmacion
    $(".formularioeliminarjuego").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Estás seguro de querer eliminar este videojuego?',
            text: "Eliminarás los datos y comentarios de este videojuego",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sí, borrar'
        }).then((result) => {

            if (result.value) {

                setTimeout(this.submit(), 3000);

            }

        });
    });



    //Eliminar reseña confirmacion
    $(".formularioeliminarresenya").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Estás seguro de querer eliminar esta reseña?',
            text: "Eliminarás los datos y comentarios de esta reseña",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sí, borrar'
        }).then((result) => {

            if (result.value) {

                setTimeout(this.submit(), 3000);

            }

        });
    });




    //Aumenta tamaño imagen showw
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
        } else {
            $("#imagenjuegoshow").css({

                'width': '30vh',
                'height': '30vh',

                'left': '35%',
                'margin-right': '200px !important',
                'z-index': 9999



            });
        }



    });


    //Cambiar password
    $("#botoncambiarcontraseña").on('click', function () {

        $("#cambiarcontraseña").toggleClass('inactivo');

        if ($("#cambiarcontraseña").hasClass('inactivo')) {
            $("#cambiarcontraseña").css({

                'display': 'block'

            });
        } else {
            $("#cambiarcontraseña").css({

                'display': 'none'


            });
        }



    });









});