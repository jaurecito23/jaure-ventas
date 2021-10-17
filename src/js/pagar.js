
let divMetodoPago = document.querySelector(".payment-method");

document.addEventListener("DOMContentLoaded",()=>{

    if(divMetodoPago){

        eventoElegirMetodoPago();

    }
})


function eventoElegirMetodoPago(){

    let opciones = document.querySelectorAll(".input-radio input[name='payment']");
    let btnTerminar = document.querySelector(".btn-terminar");
    let divBtnPago = document.querySelector(".div-Btn-Pago");



    opciones.forEach((opcion)=>{


        opcion.addEventListener("change",(e)=>{
            let idPago = e.target.id;


            if( idPago == "payment-1" || idPago == "payment-4" || idPago == "payment-5"){


                btnTerminar.style.display = "block";
                divBtnPago.style.display = "none";

            }else if( idPago == "payment-2" || idPago == "payment-3"){


                btnTerminar.style.display = "none";
                divBtnPago.style.display = "block";


            };


        })

    })



}