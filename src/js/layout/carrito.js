document.addEventListener("DOMContentLoaded",()=>{


    llenarCarrito();
    eventoAñadirCarrito();


    eventoBorarCarrito();
    llenarFavoritos();


});



function eventoAñadirCarrito(){


    let btnAñadirCarrito = document.querySelectorAll(".add-to-cart-btn");
    btnAñadirCarrito.forEach((btn)=>{


        btn.addEventListener("click",(e)=>{

            let id = e.target.getAttribute("data-id");


            ////console.log(id);

            let datos = new FormData();

            datos.append("id",id);

            let xhr = new XMLHttpRequest();

            xhr.open("POST","../controllersCarritos/agregarProducto.php",false);

            xhr.onload = function(){

                if(xhr.status === 200){

                    let respuesta = JSON.parse(xhr.responseText);
                    // let respuesta = xhr.responseText;

                    //console.log(respuesta,"agregando a carrito")


                    if(respuesta){

                        llenarCarrito();

                          Swal.fire({
                            title: `¡ Excelente, agregaste ${respuesta.nombre} !`,
                            text: 'Gracias por confiar en nosotros , nos esforzamos dia a dia para brindarte lo mejor',
                            imageUrl: `../imagenes_productos/${respuesta.imagenes[0]}`,
                            imageWidth: 400,
                            imageHeight: 200,
                            imageAlt: `Imagen ${respuesta.nombre}`,
                          })


                          setTimeout(() => {

                            alertaPagar();

                          }, 2000);

                    }

                    ////console.log(respuesta);

                }

            }

            xhr.send(datos);


        })

    })


}


function llenarCarrito (){

    // Obtiene y llena el carrito
    xhr = new XMLHttpRequest();

    xhr.open("GET","../controllersCarritos/llenarCarrito.php",false);



    xhr.onload = function(){

        if(xhr.status === 200){

            let respuesta = JSON.parse(xhr.responseText);
          // let respuesta = xhr.responseText;
            //console.log(respuesta,"llenar Carrito");

            ponerProductosCarrito(respuesta);


            setTimeout(() => {
                obtenerTotal();

            }, 4000);

        }

    }

    xhr.send();
}


// Agrega PRoduuctos al html del carrito
function ponerProductosCarrito(productos){

    var listadoCarrito = document.querySelector(".lista-carrito");

    ////console.log(productos,"productos");

    // Resetea el listado de productos

    listadoCarrito.innerHTML = "";
    cantidadProductos = 0;
    productos.forEach((producto)=>{

        let productoAnterior = document.querySelector(`.precio-producto span[data-id='${producto.id}']`);

        // Si existe uno anterior no lo crea nuevamente , aumenta la cantidad
        if(productoAnterior !== null){

          let cantidadAnterior = parseInt(productoAnterior.textContent);
            cantidadAnterior++;
        productoAnterior.textContent = cantidadAnterior;

            ////console.log("ES NULL");

       }else{


           listadoCarrito.innerHTML += `
                <div class="product-widget" data-id="${producto.id}">
                <div class="product-img"data-id="${producto.id}" >
                <a href="producto?id=${producto.id}"> <img src="../imagenes_productos/${producto.imagenes[0]}" alt=""></a>

                   </div>
               <div class="product-body" data-id="${producto.id}">
               <h3 class="product-name"><a href="producto?id=${producto.id}">${producto.nombre}</a></h3>
               <h4 class="product-price precio-producto"><span data-id=${producto.id} class="qty cantidad">1x</span>$${producto.precio}</h4>
              </div>
              <button class="delete delete-carrito" data-id="${producto.id}"><i class="fa fa-close"></i></button>
             </div>

        `;
    }

        cantidadProductos++;
    });


    setearCantidadProductos(cantidadProductos);
    eventoBorarCarrito();

}



// Setea en HTML la cantidad de productos
function setearCantidadProductos(cantidad){

    let cantidadProductosCarrito = document.querySelector(".cart-summary small span");

    cantidadProductosCarrito.textContent = cantidad;

    let cantidadProductosCarrito2 = document.querySelector(".carrito .cantidad");
    cantidadProductosCarrito2.textContent = cantidad;


}

function setearTotal(total){

    // Setea el total
 var total = parseInt(total);
let totalCarrito = document.querySelector(".cart-summary h5");



totalCarrito.textContent = "SUBTOTAL: $"+total+".00";

}



// FUncion para obtener el total del carrito
function obtenerTotal(){

    xhr = new XMLHttpRequest();


    xhr.open("GET","../controllersCarritos/obtenerTotal.php",true);

   var total = 0;
   xhr.onload = function(){

        total = 0;
        if(xhr.status === 200){

           let respuesta = xhr.responseText;
            // let respuesta = xhr.responseText;
            // Setea el total en el HTML
           setearTotal(respuesta)
           //console.log(respuesta,"total");
        }

        ////console.log(total);
    }

    xhr.send();


}



// Funcion para borrar elementos del carrito


function eventoBorarCarrito(){

    let btnBorrar = document.querySelectorAll(".product-widget .delete-carrito");
    ////console.log(btnBorrar);
    btnBorrar.forEach((btn)=>{

        btn.addEventListener("click",(e)=>{

           let id = e.target.parentElement.getAttribute("data-id");




           Swal.fire({
            title: '¿Estas Seguro?',
            text: "¿ Seguro que quieres eliminar este Producto ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si , Eliminar',
            cancelButtonText: "Cancelar"
          }).then((result) => {
            if (result.isConfirmed) {

                borrarProducto(id);


                ////console.log(id);


            }});



        });


    });



}


// Funcion para borrar Productos

    function borrarProducto(id){


        let xhr = new XMLHttpRequest();

        let datos = new FormData();

        datos.append("id",id);

        xhr.open("POST","../controllersCarritos/borrarProducto.php",true);

        xhr.onload = function(){

            if(xhr.status === 200){

                    let respuesta = JSON.parse(xhr.responseText);


                    if(respuesta.resultado){

                        Swal.fire(
                            'Eliminado',
                            'Se ha eliminado Correctamente',
                            'success'
                          )

                    }else{

                        Swal.fire(
                            'Error',
                            'Hubo un error al intentar eliminarlo, intenta nuevamente',
                            'success'
                          )

                    };

                    llenarCarrito();


            }

        }

        xhr.send(datos);
    }
