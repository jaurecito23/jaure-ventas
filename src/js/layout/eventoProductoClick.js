// Redirige cuando pinchameos en la imagen

function eventoClickAroductos(){


    let productos = document.querySelectorAll(".product-img img");

    productos.forEach((pro)=>{

        //console.log("hola");
        pro.addEventListener("click",(e)=>{

            id = e.target.getAttribute("data-id");

            window.location.href = `/accesorios/ventas-jaure/producto?id=${id}`;

        })

    })

}