// Funcion para que redirija cuando se hace click en el box de una categoria


function eventoClickAShops(){


    let shops = document.querySelectorAll(".shop");

    shops.forEach(btn => {


        btn.addEventListener("click",(e)=>{

            btnPulsado = e.target;
           let id = btnPulsado.getAttribute("data-categoria");

           window.location.href = `/accesorios/ventas-jaure/tienda?categoria=${id}`;

        });

    });

}