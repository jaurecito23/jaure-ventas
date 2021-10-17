
let formularioCuenta = document.querySelectorAll(".formulario-datos-cuenta");

document.addEventListener("DOMContentLoaded",()=>{

    if(formularioCuenta){

        eventoActualizar();
    }

});



function eventoActualizar(){

let inputs = document.querySelectorAll(".formulario-datos-cuenta .input");

inputs.forEach((input)=>{

    input.addEventListener("change",actualizarDatosCuenta)

})



}


function actualizarDatosCuenta(e) {

    let tipo = e.target.getAttribute("data-tipo");
    let valor = e.target.value;

    let xhr = new XMLHttpRequest();

    let datos = new FormData();

    datos.append("tipo",tipo);
    datos.append("valor",valor);

    xhr.open("POST","../controllerUsuario/actualizar.php",true);


    xhr.onload = function(){

        if(xhr.status === 200){

            let respuesta = JSON.parse(xhr.responseText);
            mostrarAlertaActualizado(respuesta);

        }

    }


    xhr.send(datos);

}

function mostrarAlertaActualizado(respuesta){

    let valor = respuesta.valor;
    let tipo = respuesta.tipo;
    let resultado = respuesta.resultado;

    console.log(resultado);
    if(resultado){

        Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            title: `Actualizamos tu ${tipo} a ${valor}`,
            showConfirmButton: false,
            timer: 1500
        })
    }else{


        Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: `No podemos Actualizar tu ${tipo} a ${valor}`,
            showConfirmButton: false,
            timer: 1500
        })

    }

}