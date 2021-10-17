//Reddirecciona a la seccion producto cuando pinchamos en vista rapida

function eventoVistaRapida(){

    let button = document.querySelectorAll(".quick-view");

    button.forEach(btn => {


        btn.addEventListener("click",(e)=>{

            let btnPulsado = null;

           if(e.target.tagName == "I"){

            btnPulsado = e.target.parentElement;


        }else{

            btnPulsado = e.target;


           }

           let id = btnPulsado.getAttribute("data-id");

           window.location.href = `/accesorios/ventas-jaure/producto?id=${id}`;

        });

    });
//console.log("HOLA")


}