let usuario = document.querySelector(".usuario");
let crearIngresar = document.querySelector(".crear-ingresar");

document.addEventListener("DOMContentLoaded",()=>{

    if(usuario !== null){

        eventoUsuario();

    }

    if(crearIngresar !== null){

        eventoCrearIngresar();

       }

});


function eventoCrearIngresar(){


    crearIngresar.addEventListener("click",()=>{


        Swal.fire({
            title: `¿Hola que deseas realizar?`,
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: '<i class="fa fa-user-o"></i> Ingresar a mi Cuenta',
            denyButtonText: `Crear Cuenta`,
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                window.location.href = "/accesorios/ventas-jaure/ingresar";


            } else if (result.isDenied) {

                window.location.href = "/accesorios/ventas-jaure/crearcuenta";

            }
          })


    })


}

function eventoUsuario(){

    nombres = usuario.textContent;

    usuario.addEventListener("click",(e)=>{


        Swal.fire({
            title: `¿Hola ${nombres} que deseas realizar?`,
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: '<i class="fa fa-user-o"></i> Ver mi Cuenta',
            denyButtonText: `Cerrar Session`,
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                window.location.href = "/accesorios/ventas-jaure/micuenta";

            } else if (result.isDenied) {

                window.location.href = "/accesorios/ventas-jaure/cerrarsession";

            }
          })


})





}
