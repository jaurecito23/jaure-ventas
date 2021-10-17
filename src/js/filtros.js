let productosTienda = document.querySelector(".productos-tienda");
document.addEventListener("DOMContentLoaded",()=>{


    if(productosTienda !== null){

        eventoFiltrarPorDescuento();
        eventoCambiarCantidad();
        eventoFiltrarPorCategoria();
        eventoFiltrarPorMarca();

    }

});

let cambiarCantidad = document.querySelector(".cambiar-cantidad");
let selectFiltro = document.querySelector(".filtrar-descuento");

let ultimo_producto = document.querySelector(".ultimo-producto");
let primer_producto = document.querySelector(".primer-producto");

let id_ultimo_producto = null;
let id_primer_producto = null;

if(ultimo_producto){

     id_ultimo_producto = ultimo_producto.value;
     id_primer_producto = primer_producto.value;


}

console.log(id_ultimo_producto,"ultimo_id");
console.log(id_primer_producto,"primer_id");
let id_categoria = 1;
let cantidadProductosMostrar = 6;




if(productosTienda !== null){

      cantidadProductosMostrar = cambiarCantidad.value;
     id_categoria = selectFiltro.getAttribute("data-categoria");

}

function eventoFiltrarPorCategoria() {

    let checkboks = document.querySelectorAll(".filtrar-por-categoria");
    ////console.log(checkboks);

    checkboks.forEach((check)=>{

        check.addEventListener("change",(e)=>{
            ////console.log(e.target.checked)

            if(e.target.checked){

                id_cat = e.target.getAttribute("data-id");

                filtrarPorPrecio(id_cat);

            }else{

                filtrarPorPrecio(id_categoria);

            }

        })

    })


}


function eventoFiltrarPorMarca() {

    let marcas = document.querySelectorAll(".filtrar-marca");


    marcas.forEach((check)=>{

        check.addEventListener("change",(e)=>{

            if(e.target.checked){

                let marca = e.target.id;

                filtrarPorMarca(marca);

            }else{

                filtrarPorPrecio(id_categoria);

            }

        })

    })


}

function eventoCambiarCantidad(){



    cambiarCantidad.addEventListener("change",(e)=>{

        cambiandoCantidad(e.target.value);

    })


}




function eventoFiltrarPorDescuento(){


    selectFiltro.addEventListener("change",(e)=>{


     if(e.target.value == 0){
       // filtra  por precio
        filtrarPorPrecio(id_categoria);

    }else{
        // filtra  por descuento

       filtrarPorDescuento(id_categoria);

     }



    });


}



function cambiandoCantidad(value){


    let xhr = new XMLHttpRequest();

    let datos = new FormData;
    ////console.log(selectFiltro.value)
    ////console.log(value)

    datos.append("tipo","cantidad");
    datos.append("id_categoria",id_categoria);
    datos.append("cantidad",value);
     datos.append("ordenarPor",selectFiltro.value);
     datos.append("id_ultimo",id_ultimo_producto);
     datos.append("id_primero",id_primer_producto);

     xhr.open("POST","../controllersFiltros/filtrarPrecioDescuento.php",true);

     xhr.onload = function(){

         if(xhr.status === 200){

      let respuesta = JSON.parse(xhr.responseText);
      //      let respuesta = xhr.responseText;

           // ////console.log(respuesta);
                let productos = respuesta.productos;
                let imagenes = respuesta.imagenes;

                let id_ultimo = respuesta.id_ultimo;
                id_ultimo_producto = id_ultimo;
                let id_primero = respuesta.id_primero;
                id_primer_producto = id_primero;

                console.log(id_primer_producto,"id_primero");

                console.log(productos,imagenes);
                ponerProductosTienda(productos,imagenes);

        }

}

    xhr.send(datos);


}

function filtrarPorDescuento(id_categoria){

    let xhr = new XMLHttpRequest();

    let datos = new FormData;

    datos.append("tipo","descuentos");
    datos.append("id_categoria",id_categoria);
    datos.append("cantidad",cantidadProductosMostrar);
    datos.append("id_ultimo",id_ultimo_producto);
    datos.append("id_primero",id_primer_producto);


    xhr.open("POST","../controllersFiltros/filtrarPrecioDescuento.php",true);

    xhr.onload = function(){

        if(xhr.status === 200){

          let respuesta = JSON.parse(xhr.responseText);
         //   let respuesta =xhr.responseText;
             let productos = respuesta.productos;
            let imagenes = respuesta.imagenes;

            let id_ultimo = respuesta.id_ultimo;
            id_ultimo_producto = id_ultimo;
            let id_primero = respuesta.id_primero;
            id_primer_producto = id_primero;

            console.log(id_primer_producto,"id_primero");

          //console.log(productos);
         console.log(productos,imagenes);
            ponerProductosTienda(productos,imagenes);

        }

    }

    xhr.send(datos);

}
function filtrarPorMarca(marca){

    ////console.log(marca);
    let xhr = new XMLHttpRequest();

    let datos = new FormData;

    datos.append("tipo","marca");
    datos.append("id_categoria",id_categoria);
    datos.append("ordenarPor",selectFiltro.value);
    datos.append("cantidad",cantidadProductosMostrar);
    datos.append("marca",marca);
    datos.append("id_ultimo",id_ultimo_producto);
    datos.append("id_ultimo",id_ultimo_producto);
    datos.append("id_primero",id_primer_producto);

    xhr.open("POST","../controllersFiltros/filtrarPrecioDescuento.php",true);

    xhr.onload = function(){

        if(xhr.status === 200){

        let respuesta = JSON.parse(xhr.responseText);
          // let respuesta =xhr.responseText;
         //  ////console.log(respuesta);
           let productos = respuesta.productos;
             let imagenes = respuesta.imagenes;

           ////console.log(productos,imagenes);
          ponerProductosTienda(productos,imagenes);

        }

    }

    xhr.send(datos);

}

// Se usa esta misma funcion para filtrar por categoria porque cumple con los requisitos necesarios
// Esta funcion es paara filtrar
function filtrarPorPrecio(id_categoria){

    let xhr = new XMLHttpRequest();

    let datos = new FormData;


    datos.append("tipo","precio");
    datos.append("id_categoria",id_categoria);
    datos.append("cantidad",cantidadProductosMostrar);
    datos.append("id_ultimo",id_ultimo_producto);
    datos.append("id_primero",id_primer_producto);


    xhr.open("POST","../controllersFiltros/filtrarPrecioDescuento.php",true);

    xhr.onload = function(){

        if(xhr.status === 200){

          let respuesta = JSON.parse(xhr.responseText);
         //   let respuesta =xhr.responseText;
            let productos = respuesta.productos;
            let imagenes = respuesta.imagenes;
            let id_ultimo = respuesta.id_ultimo;
            id_ultimo_producto = id_ultimo;
            let id_primero = respuesta.id_primero;
            id_primer_producto = id_primero;

            console.log(id_primer_producto,"id_primero");

           console.log(respuesta);
           ////console.log(productos,imagenes);
           ponerProductosTienda(productos,imagenes);

        }

    }

    xhr.send(datos);


}






//Pone los productos en la tienda

function ponerProductosTienda(productos,imagenes){



    productosTienda.innerHTML = "";

    productos.forEach((producto)=>{
        id_ultimo_producto = producto.id;
        let imagen = imagenes[producto.id][0];


        productosTienda.innerHTML += `

        <!-- product -->
        <div class="col-md-4 col-xs-6">
        <div class="product">
        <div class="product-img">
            <img src="../imagenes_productos/${imagen}"  data-id="${producto.id}" alt="">
            <div class="product-label">
                <span class="sale">-${producto.descuento}%</span>
                <span class="new">OFERTA</span>
            </div>
        </div>
        <div class="product-body">
            <p class="product-category">Auriculares</p>
            <h3 class="product-name"><a href="producto?id=${producto.id}">${producto.nombre}</a></h3>
            <h4 class="product-price">$${producto.precio} <del class="product-old-price">$${producto.precio_anterior}</del></h4>
            <div class="product-rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>
            <div class="product-btns">
                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Añadir a Favoritos</span></button>
                <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">Comparar</span></button>
                <button class="quick-view" data-id="${producto.id}"><i class="fa fa-eye"></i><span class="tooltipp">Vista Rapida</span></button>
            </div>
        </div>
        <div class="add-to-cart">
            <button class="add-to-cart-btn" data-id="${producto.id}"><i class="fa fa-shopping-cart"></i> Añadir al Carrito </button>
        </div>
        </div>
        </div>
        <!-- /product -->
        <div class="clearfix visible-sm visible-xs"></div>


        `;


    })

    eventoClickAroductos();
    eventoAñadirCarrito();
    eventoVistaRapida()


}