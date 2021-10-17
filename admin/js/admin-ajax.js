$(document).ready(function () {

    $("#crear-admin").on("submit",function (e) {

        e.preventDefault();

       var datos = $(this).serializeArray();

       $.ajax({

        type: $(this).attr("method"),
        data: datos,
        url: $(this).attr("action"),
        dataType: "json",
        success: function (data) {

            var resultado = data;

            if(resultado.respuesta == "exito"){

                Swal.fire(
                    'Excelente',
                    'Se ha creado el nuevo administrador',
                    'success'
                  )

                }else{

                    Swal.fire(
                        'Error',
                        'Oops , ese usuario ya existe',
                        'error'
                      )

            }

        }


       });



    });


});