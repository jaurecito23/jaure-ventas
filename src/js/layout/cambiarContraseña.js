let btnCambiarContraseña = document.querySelector(".boton-cambiar-contraseña");
let btnCambiarContraseñaIngresar = document.querySelector(".boton-cambiar-contraseña-ingresar");

document.addEventListener("DOMContentLoaded",()=>{

    if(btnCambiarContraseña){
        eventoCambiarContraseña();
    }

    if(btnCambiarContraseñaIngresar){
        eventoCambiarContraseñaIngresar();
    }

});



function eventoCambiarContraseña(){

    let btnOlvideContra = document.querySelectorAll(".olvide-contraseña");


    btnOlvideContra.forEach((btn)=>{

        btn.addEventListener("click",()=>{


            btnCambiarContraseña.innerHTML = "<i style='font-size: 3.5rem;'class='fas fa-circle-notch fa-spin'></i>"

              let xhr = new XMLHttpRequest();


              xhr.open("POST","../controllerUsuario/emailContraseña.php",true);



              xhr.onload = function(){

                  if(xhr.status === 200){

                 //    let respuesta = JSON.parse(xhr.responseText);
                     let respuesta = xhr.responseText;

                     console.log(respuesta);

                  }
                }



              xhr.send();


            setTimeout(() => {

                Swal.fire({
                    icon: 'success',
                    title: '¡Excelente!',
                    text: 'Te enviamos un email para que puedas restaurarla',
                    footer: '<a href="https://api.whatsapp.com/send?phone=59893693110&text=Hola%20%C2%BF%20como%20estan%20?,%20tengo%20un%20problema%20para%20restaurar%20mi%20contrase%C3%B1a,%20%C2%BFpodrian%20ayudarme?">¿ No te llega el email ?</a>'
                })

                btnCambiarContraseña.innerHTML = "Revisa tu email (Podria estar en la carpeta de spam)"
            }, 300);

        })


    })


}

function eventoCambiarContraseñaIngresar(){

    let btnOlvideContra = document.querySelectorAll(".olvide-contraseña-ingresar");


    btnOlvideContra.forEach((btn)=>{

        btn.addEventListener("click",(e)=>{

            console.log(e.target);

            let email = null;

            Swal.fire({
                title: 'Por favor ingrese su correo electronico',
                input: 'text',
                inputAttributes: {
                  autocapitalize: 'off'
                },
                showCancelButton: false,
                confirmButtonText: 'Enviar Mail de Verificacion',

                })
                .then((result) => {
                if (result.isConfirmed) {
                    email = result.value;

                    btnCambiarContraseñaIngresar.innerHTML = "<i style='font-size: 3.5rem;'class='fas fa-circle-notch fa-spin'></i>"


                    cambiarContraseñaIngresar(email);


            }
        })


     })

 })




    //         setTimeout(() => {

    //             Swal.fire({
    //                 icon: 'success',
    //                 title: '¡Excelente!',
    //                 text: 'Te enviamos un email para que puedas restaurarla',
    //                 footer: '<a href="https://api.whatsapp.com/send?phone=59893693110&text=Hola%20%C2%BF%20como%20estan%20?,%20tengo%20un%20problema%20para%20restaurar%20mi%20contrase%C3%B1a,%20%C2%BFpodrian%20ayudarme?">¿ No te llega el email ?</a>'
    //             })

    //             btnCambiarContraseña.innerHTML = "Revisa tu email (Podria estar en la carpeta de span)"
    //         }, 300);

}


function  cambiarContraseñaIngresar(email) {

    console.log(email);

    let xhr = new XMLHttpRequest();


         xhr.open("POST","../controllerUsuario/emailContraseñaIngresar.php",true);

        let datos = new FormData();

        datos.append("email",email)

          xhr.onload = function(){

             if(xhr.status === 200){

              let respuesta = JSON.parse(xhr.responseText);
              //   let respuesta = xhr.responseText;

                      if(respuesta.resultado){
                          btnCambiarContraseñaIngresar.innerHTML = "Revisa tu email (Podria estar en la carpeta de spam)";
                          Swal.fire({
                              icon: 'success',
                            title: '¡Excelente!',
                            text: 'Te enviamos un email para que puedas restaurarla',
                            footer: '<a href="https://api.whatsapp.com/send?phone=59893693110&text=Hola%20%C2%BF%20como%20estan%20?,%20tengo%20un%20problema%20para%20restaurar%20mi%20contrase%C3%B1a,%20%C2%BFpodrian%20ayudarme?">¿ No te llega el email ?</a>'
                        })

                    }else{

                        btnCambiarContraseñaIngresar.innerHTML = "Intenta con otro email o <a href='/accesorios/ventas-jaure/crearcuenta'>Crea tu cuenta</a>";
                        Swal.fire({
                            icon: 'error',
                            title: '¡Error!',
                            text: 'El correo ingresado no esta registrado en jaureventas',
                            footer: '<a href="https://api.whatsapp.com/send?phone=59893693110&text=Hola%20%C2%BF%20como%20estan%20?,%20tengo%20un%20problema%20para%20restaurar%20mi%20contrase%C3%B1a,%20%C2%BFpodrian%20ayudarme?">Contactanos</a>'
                        })

                      }

              }
          }



          xhr.send(datos);


}