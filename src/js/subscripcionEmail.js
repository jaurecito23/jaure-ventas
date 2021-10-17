

let inputEmailSubscribirse = document.querySelector(".input-email-subscribirse");
console.log(inputEmailSubscribirse);

document.addEventListener("DOMContentLoaded",()=>{

    if(inputEmailSubscribirse){

        eventoSubscribirse();

    }

})

function eventoSubscribirse(){


    let btnSubscribirse = document.querySelector(".newsletter-btn");


    console.log(btnSubscribirse);


    btnSubscribirse.addEventListener("click",(e)=>{
        e.preventDefault();
        //Validar valor input

        let email = inputEmailSubscribirse.value;

        if(email.indexOf("@") == -1){

            Swal.fire({
                icon: "error",
                title: `¡Oops!`,
                text: 'El email ingresado no es válido , porque no contiene un @',
            })

        }else if(email.length < 5){


            Swal.fire({
                icon: "error",
                title: `¡Oops!`,
                text: 'El email ingresado no es válido',
            })

        }else{

            let xhr = new XMLHttpRequest();

            let datos = new FormData();

            datos.append("email",email);

            xhr.open("POST","../controllersMarketing/registrarEmail.php");

            xhr.onload = function(){

                if(xhr.status === 200){

                    let respuesta = JSON.parse(xhr.responseText);
                    if(respuesta.resultado){
                        Swal.fire({
                            icon: "success",
                            title: `¡No te perderas de nuestras increíbles ofertas!`,
                            text:`Porque ${respuesta.email} ya se encuentra en nuestra base de datos.`,
                        })
                    };

                }

            }

            xhr.send(datos);

        }


    })



}