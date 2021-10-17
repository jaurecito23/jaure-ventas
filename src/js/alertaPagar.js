function alertaPagar(){

    Swal.fire({
        title: '¡Termina tu Compra!',
        html: "<p style='font-size:14px; font-weight:bold; '>¿ Quires ir a la seccion de pago ? <br><span  style='font-size:10px;color:#11B009>Enviaremos tus productos cuanto antes</span></p>",
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#11B009',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si , terminar ahora',
        cancelButtonText: "Quiero agregar más productos"
      }).then((result) => {
        if (result.isConfirmed) {

            window.location.href = "pagar"

        }});

}