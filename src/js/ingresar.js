let formIngresar = document.querySelector(".formulario-ingresar");


document.addEventListener("DOMContentLoaded",()=>{


    if(formIngresar !== null){

        eventoMostrarContraseña();

    }

})


function eventoMostrarContraseña(){

    let mostrarContraseña = document.querySelector(".mostrar-contraseñas");
    let inputContraseña = document.querySelector(".contraseña1");


    mostrarContraseña.addEventListener("change",()=>{

        if(mostrarContraseña.checked){

            inputContraseña.setAttribute("type","text");
            
        }else{
            
            inputContraseña.setAttribute("type","password");


        }


    })



}