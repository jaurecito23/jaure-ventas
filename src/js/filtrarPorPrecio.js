document.addEventListener("DOMContentLoaded",()=>{

    if(productosTienda !== null){
    eventoFiltrarPorPrecio();
    }

});

    let inputMax = document.querySelector("#price-max");
    let inputMin = document.querySelector("#price-min");

    let activarSlider = false;
function eventoFiltrarPorPrecio(){



    inputMax.addEventListener("change",()=>{


        filtrarPorPrecioSlider();

    })

    inputMin.addEventListener("change",()=>{


        filtrarPorPrecioSlider();


    })


    activarSlider = true;


}


function filtrarPorPrecioSlider(){
    let maximo = inputMax.value;
    let minimo = inputMin.value;
    ////console.log(minimo);


    setTimeout(() => {


        let xhr = new XMLHttpRequest();

        let datos = new FormData;
        ////console.log(selectFiltro.value)


        datos.append("tipo","precioSlider");
        datos.append("id_categoria",id_categoria);
        datos.append("cantidad",cantidadProductosMostrar);
        datos.append("maximo",maximo);
        datos.append("minimo",minimo);


         xhr.open("POST","../controllersFiltros/filtrarPrecioDescuento.php",true);

         xhr.onload = function(){

             if(xhr.status === 200){

          let respuesta = JSON.parse(xhr.responseText);
             // let respuesta = xhr.responseText;

               ////console.log(respuesta);
                     let productos = respuesta.productos;
                     let imagenes = respuesta.imagenes;
                    ////console.log(productos,imagenes);
                    ponerProductosTienda(productos,imagenes);

            }

    }

        xhr.send(datos);




    },100);

}