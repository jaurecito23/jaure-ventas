let formularioCrear = document.querySelector(".formulario-crear");
let formulario = document.querySelector(".formulario");

console.log(formulario);

document.addEventListener("DOMContentLoaded",()=>{

    if(formulario !== null){

        eventoValidarFormulario();

    }

    if(formularioCrear !== null){

        eventoMostrarContraseñas();
        eventoValidarFormularioCrear();

    }

});


let nombres = document.querySelector(".nombres");
let apellidos = document.querySelector(".apellidos");
let email = document.querySelector(".email");
let direccion = document.querySelector(".direccion");
let ciudad = document.querySelector(".ciudad");
let localidad = document.querySelector(".localidad");
let celular = document.querySelector(".celular");


    let contraseña2 = document.querySelector(".contraseña2");
    let contraseña = document.querySelector(".contraseña");
    let terminos = document.querySelector(".terminos");
    let mostrarContraseñas = document.querySelector(".mostrar-contraseñas");
    if(terminos !== null){

        terminos.checked = true;
    }

    let errores = [];


function eventoMostrarContraseñas(){

    mostrarContraseñas.addEventListener("change",(e)=>{

        if(e.target.checked){

            contraseña.setAttribute("type","text")
            contraseña2.setAttribute("type","text")

        }else{

            contraseña.setAttribute("type","password")
            contraseña2.setAttribute("type","password")


        }


    })


}


function eventoValidarFormulario(){



    // VALIDAR POR EVENTO , Solo cuando cambia

    // Validacion de nombres
    validarNombre();

    // Validacion de apellidoss

    validarApellido();

    // Validacion de email
    validarEmail();

    // Validacion de direccion
        validarDireccion();
    // Validacion de ciudad

        validarCiudad();

    // Validacion de localidad
        validarLocalidad();

    // Validacion de Celular
      validarCelular();

 }

function eventoValidarFormularioCrear(){

    // Evento Terminos
    eventoTerminos();


    // Validacion de Contraseñas
        validarContraseña();



}


function validarNombre(){

    nombres.addEventListener("change",(e)=>{


        let valor = e.target.value;



        if(valor.length < 3 || valor == ""){

        e.target.parentElement.childNodes[3].style.display = "block";
        errores.push("Completa tu nombre correctamente");
        ponerErrores(errores)
    }else{

        e.target.parentElement.childNodes[3].style.display = "none";

        errores = errores.filter(error=> error !== "Completa tu nombre correctamente");
        ponerErrores(errores)

        }

        habilitarBotonSubmit();

    })

}


  function validarApellido(){

    apellidos.addEventListener("change",(e)=>{


        let valor = e.target.value;


        if(valor.length < 3 || valor == ""){

        e.target.parentElement.childNodes[3].style.display = "block";
        ponerErrores(errores)

    }else{

        e.target.parentElement.childNodes[3].style.display = "none";
        errores = errores.filter(error=> error !== "Completa tu apellido correctamente");
        ponerErrores(errores)

        }

        habilitarBotonSubmit()
    })

 }


 function validarEmail(){

    email.addEventListener("change",(e)=>{


        let valor = e.target.value;


        if(valor.indexOf("@") == -1 || valor == ""){

            e.target.parentElement.childNodes[3].style.display = "block";
            errores.push("El email debe contener @");
            ponerErrores(errores)

        }else{

            e.target.parentElement.childNodes[3].style.display = "none";

        errores = errores.filter(error=> error !== "El email debe contener @");
        ponerErrores(errores)

    }

    habilitarBotonSubmit();


})

 }


 function validarDireccion(){

    direccion.addEventListener("change",(e)=>{


        let valor = e.target.value;


        if(valor.length < 8 || valor == ""){

            e.target.parentElement.childNodes[3].style.display = "block";
            errores.push("Debes añadir una dirección mayor a 8 caracteres");
            ponerErrores(errores);

        }else{

            e.target.parentElement.childNodes[3].style.display = "none";
            errores = errores.filter(error=> error !== "Debes añadir una dirección mayor a 8 caracteres");
            ponerErrores(errores)

        }
        habilitarBotonSubmit()

    })

 }



 function validarCiudad(){

    ciudad.addEventListener("change",(e)=>{


        let valor = e.target.value;


        if(valor.length < 3 || valor == ""){

            e.target.parentElement.childNodes[3].style.display = "block";

            errores.push("Debes añadir una ciudad");
            ponerErrores(errores)

        }else{

            e.target.parentElement.childNodes[3].style.display = "none";
            errores = errores.filter(error=> error !== "Debes añadir una ciudad");
            ponerErrores(errores)

        }

        habilitarBotonSubmit()
    })

 }


 function validarLocalidad(){

    localidad.addEventListener("change",(e)=>{


        let valor = e.target.value;


        if(valor.length < 3 || valor == ""){

            e.target.parentElement.childNodes[3].style.display = "block";
            errores.push("Debes añadir una Localidad/Pueblo");
            ponerErrores(errores)

        }else{

            e.target.parentElement.childNodes[3].style.display = "none";
            errores = errores.filter(error=> error !== "Debes añadir una Localidad/Pueblo");
            ponerErrores(errores)

        }
        habilitarBotonSubmit()

    })


 }




 function validarCelular(){
    celular.addEventListener("change",(e)=>{


        let valor = e.target.value;


        if(valor.length !== 9 || valor.indexOf("0") == -1 ||  valor.indexOf("9") == -1 || valor == ""){

            e.target.parentElement.childNodes[3].style.display = "block";
            errores.push("Debes añadir un Celular Válido con 9 digitos y este formato : 093 693 110");
            ponerErrores(errores)

        }else{

            e.target.parentElement.childNodes[3].style.display = "none";
            errores = errores.filter(error=> error !== "Debes añadir un Celular Válido con 9 digitos y este formato : 093 693 110");
            ponerErrores(errores)

        }

        habilitarBotonSubmit()
    })



 }



 function validarContraseña(){

    contraseña2.addEventListener("change",(e)=>{


        let valor1 = e.target.value;
        let valor2 = contraseña.value;

        if(valor1 == "" || valor2 == "" || valor1.length < 8 || valor2.length < 8){

            errores.push("Debes añadir una Contraseña Válida");
            e.target.parentElement.childNodes[15].style.display = "block";
            ponerErrores(errores)

        }else if(valor1 !== "" || valor2 !== "" || valor1.length >= 8 || valor2.length >= 8){

            e.target.parentElement.childNodes[15].style.display = "none";
            errores = errores.filter(error=> error !== "Debes añadir una Contraseña Válida");
            ponerErrores(errores)

            if(valor1 !== valor2){

                errores.push("Las contraseñas deben coincidir");
                ponerErrores(errores)
                e.target.parentElement.childNodes[13].style.display = "block";

            }else{


                e.target.parentElement.childNodes[13].style.display = "none";
                errores = errores.filter(error=> error !== "Las contraseñas deben coincidir");
                ponerErrores(errores)

            }


        }

        habilitarBotonSubmit()

    })



 }


 function eventoTerminos(){

    terminos.addEventListener("change",(e)=>{


        let valor = e.target.checked;



         if(!valor){

            console.log( e.target.parentElement.childNodes)
            e.target.parentElement.childNodes[5].style.display = "block";
             errores.push("Debes Seleccionar los términos y condiciones de jaureventas");
             ponerErrores(errores)

         }else{

        e.target.parentElement.childNodes[5].style.display = "none";
             errores = errores.filter(error=> error !== "Debes Seleccionar los términos y condiciones de jaureventas");
             ponerErrores(errores)

         }

         habilitarBotonSubmit()
    })

 }
///////////////////////////////////////////////////////////////////////////////////////
 function validarFormPrimeraVez(){


//     // VALIDAR POR PRIMERA VEZ

//     // Validacion de nombres

    errores = [];

    let valorNombre = nombres.value;



     if(valorNombre.length < 3 || valorNombre == ""){

     nombres.parentElement.childNodes[3].style.display = "block";
     errores.push("Completa tu nombre correctamente");
     ponerErrores(errores)
 }else{

     nombres.parentElement.childNodes[3].style.display = "none";
         errores = errores.filter(error=> error !== "Completa tu nombre correctamente");
     ponerErrores(errores)

     }



// // Validacion de apellidoss



     let valorApellido = apellidos.value;


    if(valorApellido.length < 3 || valorApellido == ""){

     apellidos.parentElement.childNodes[3].style.display = "block";
     ponerErrores(errores)

 }else{

    apellidos.parentElement.childNodes[3].style.display = "none";
     errores = errores.filter(error=> error !== "Completa tu apellido correctamente");
     ponerErrores(errores)

     }



// // Validacion de email



     let valorEmail = email.value;


     if(valorEmail.indexOf("@") == -1 || valorEmail == ""){

         email.parentElement.childNodes[3].style.display = "block";
         errores.push("El email debe contener @");
         ponerErrores(errores)

     }else{

         email.parentElement.childNodes[3].style.display = "none";

     errores = errores.filter(error=> error !== "El email debe contener @");
     ponerErrores(errores)

 }




// // Validacion de direccion



     let valorDireccion = direccion.value;


     if(valorDireccion.length < 8 || valorDireccion == ""){

         direccion.parentElement.childNodes[3].style.display = "block";
         errores.push("Debes añadir una dirección mayor a 8 caracteres");
         ponerErrores(errores);

     }else{

         direccion.parentElement.childNodes[3].style.display = "none";
         errores = errores.filter(error=> error !== "Debes añadir una dirección mayor a 8 caracteres");
         ponerErrores(errores)

     }



// // Validacion de ciudad


     let valorCiudad = ciudad.value;


     if(valorCiudad.length < 3 || valorCiudad == ""){

         ciudad.parentElement.childNodes[3].style.display = "block";

         errores.push("Debes añadir una ciudad");
         ponerErrores(errores)

     }else{

        ciudad.parentElement.childNodes[3].style.display = "none";
         errores = errores.filter(error=> error !== "Debes añadir una ciudad");
         ponerErrores(errores)

     }



// // Validacion de localidad


     let valorLocalidad = localidad.value;


     if(valorLocalidad.length < 3 || valorLocalidad == ""){

         localidad.parentElement.childNodes[3].style.display = "block";
         errores.push("Debes añadir una Localidad/Pueblo");
        ponerErrores(errores)

     }else{

        localidad.parentElement.childNodes[3].style.display = "none";
         errores = errores.filter(error=> error !== "Debes añadir una Localidad/Pueblo");
        ponerErrores(errores)

    }



// // Validacion de Celular



     let valorCelular = celular.value;


     if(valorCelular.length !== 9 || valorCelular.indexOf("0") == -1 ||  valorCelular.indexOf("9") == -1 || valorCelular == ""){

         ciudad.parentElement.childNodes[3].style.display = "block";
         errores.push("Debes añadir un Celular Válido con 9 digitos y este formato : 093 693 110");
         ponerErrores(errores)

     }else{

        ciudad.parentElement.childNodes[3].style.display = "none";
         errores = errores.filter(error=> error !== "Debes añadir un Celular Válido con 9 digitos y este formato : 093 693 110");
         ponerErrores(errores)

     }



// // Validacion de Contraseñas

     let valor1 = contraseña2.value;
     let valor2 = contraseña.value;

     if(valor1 == "" || valor2 == "" || valor1.length < 8 || valor2.length < 8){

         errores.push("Debes añadir una Contraseña Válida");
         contraseña2.parentElement.childNodes[15].style.display = "block";
         ponerErrores(errores)

     }else if(valor1 !== "" || valor2 !== "" || valor1.length >= 8 || valor2.length >= 8){

        contraseña2.parentElement.childNodes[15].style.display = "none";
         errores = errores.filter(error=> error !== "Debes añadir una Contraseña Válida");
         ponerErrores(errores)

         if(valor1 !== valor2){

             errores.push("Las contraseñas deben coincidir");
             ponerErrores(errores)
             contraseña2.parentElement.childNodes[13].style.display = "block";

         }else{


             contraseña2.parentElement.childNodes[13].style.display = "none";
             errores = errores.filter(error=> error !== "Las contraseñas deben coincidir");
             ponerErrores(errores)

         }


     }

     habilitarBotonSubmit()



    }



function ponerErrores(errores){


    let divErrores = document.querySelector(".errores-form");

    console.log(divErrores);

    divErrores.innerHTML = "";

    errores.forEach((error)=>{

        divErrores.innerHTML += `<p> *${error} </p>`;


    })


}






function habilitarBotonSubmit(){

    if(formularioCrear){


    let btnSubmit = document.querySelector(".btn-crearcuenta");

        if(errores.length === 0){

            let validado = validarFormTrueFalse();

            if(validado){

                btnSubmit.setAttribute("type","submit");
                btnSubmit.parentElement.innerHTML +=  "<p class='error-btn'  style='text-align: center;display=block; color: green;'> Pulasa el Boton Crear Cuenta </p> ";

                setTimeout(()=>{

                    document.querySelector(".error-btn").remove();

                },2000);

            }

        }else{


             btnSubmit.addEventListener("click",(e)=>{

                 e.preventDefault();

                    e.target.parentElement.innerHTML +=  "<p class='error-btn'  style='text-align: center;display=block; color: red;'> Debes completar todos los campos</p> ";
                    validarFormPrimeraVez();



               })

     }

    }
}



 function validarFormTrueFalse(){



    if(nombres.value !== "" && apellidos.value !== "" && email.value !== ""  && direccion.value !== "" && ciudad.value !== "" &&  localidad.value !== "" && celular.value !== "" && contraseña2.value !==  "" && contraseña.value !== "" && terminos.checked ){

        return true;

    }else{

        return false;

    }

}