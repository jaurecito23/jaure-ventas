
let favorito = document.querySelector(".favorito");
document.addEventListener("DOMContentLoaded",()=>{

    if(favorito){

        eventoAñadirFavorito();


    }

})



function eventoAñadirFavorito(){

    let btnAñadirFavoritos = document.querySelectorAll(".add-to-wishlist");



    btnAñadirFavoritos.forEach((btn)=>{


        btn.addEventListener("click",(e)=>{

            let id = null;
            let divClick = e.target.parentElement;
            if(divClick.classList.contains("product-btns")){

                ////console.log(divClick,"inlcuye");
              id = divClick.childNodes[5].getAttribute("data-id");

            }else{

               id = divClick.parentElement.childNodes[5].getAttribute("data-id");
            }

            ////console.log(id);




            let datos = new FormData();

            datos.append("id",id);

            let xhr = new XMLHttpRequest();

            xhr.open("POST","../controllersFavoritos/agregarFavorito.php",true);

            xhr.onload = function(){

                if(xhr.status === 200){

                    let respuesta = JSON.parse(xhr.responseText);

                    //console.log(respuesta, "agrego favorito");
                   //let respuesta = xhr.responseText;

                    if(respuesta.existeUsuario){

                        if(respuesta.resultado){

                            ////console.log(respuesta);
                             llenarFavoritos();
                            Swal.fire({
                                icon: "success",
                                title: `¡ Excelente!`,
                                text: 'El producto ya se agrego en a tus favoritos',
                              })


                        }else{

                            Swal.fire({
                                icon: "error",
                                title: `¡ Oops!`,
                                text: 'El producto ya se encuentra en favoritos',
                              })

                        }


                    }else{

                           Swal.fire({
                             icon: "error",
                             title: `¡ Registrate o Inicia Session!`,
                             text: 'Debes estar registrado para añadir productos',
                           })


                    }



                }

            }

            xhr.send(datos);


        })

    })


}


function llenarFavoritos(){


      // Obtiene y llena los favoritos
      xhr = new XMLHttpRequest();

      xhr.open("GET","../controllersFavoritos/llenarFavoritos.php",false);


      xhr.onload = function(){

          if(xhr.status === 200){

              let respuesta = JSON.parse(xhr.responseText);
             // let respuesta = xhr.responseText;

             //console.log(respuesta,"LLenar Favoritos");

             ////console.log(respuesta,"llenando");
                ponerProductosFavoritos(respuesta.productos);


          }

      }

      xhr.send();

}

// Agrega PRoduuctos al html del carrito
function ponerProductosFavoritos(productoss){

    var listadoFavorito = document.querySelector(".lista-favorito-list");

    ////console.log(listadoFavorito,"listado - favorito");

    // Resetea el listado de productos

    listadoFavorito.innerHTML = "";
    cantidadFavoritos = 0;

         if(productoss.length > 0){


             
             productoss.forEach((producto)=>{
                 
                 

           listadoFavorito.innerHTML += `
                <div class="product-widget">
                <div class="product-img">
                   <img src="../imagenes_productos/${producto.imagen}" alt="">
                   </div>
               <div class="product-body">
               <h3 class="product-name"><a href="producto?id=${producto.id}">${producto.nombre}</a></h3>
               <h4 class="product-price price-favorito"><span data-id=${producto.id} class="qty cantidad">1x</span>$${producto.precio}</h4>
              </div>
              <button class="delete delete-favorito" data-id="${producto.id}"><i class="fa fa-close delete-favorito" data-id="${producto.id}"></i></button>
             </div>

        `;
        cantidadFavoritos++;

    });

}   
    
   setearCantidadFavoritos(cantidadFavoritos);
   eventoBorarFavorito();
   
}

// Setea en HTML la cantidad de productos
function setearCantidadFavoritos(cantidad){

    let cantidadProductosCarrito2 = document.querySelector(".favorito .cantidad");
    cantidadProductosCarrito2.textContent = cantidad;


}


// Funcion para borrar elementos del carrito


function eventoBorarFavorito(){

    let btnBorrar = document.querySelectorAll(".product-widget .delete-favorito");
    ////console.log(btnBorrar);
    btnBorrar.forEach((btn)=>{

        btn.addEventListener("click",(e)=>{

            let id = e.target.getAttribute("data-id");

           Swal.fire({
            title: '¿Estas Seguro?',
            text: "¿ Seguro que quieres eliminarlo de tus favoritos?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si , Eliminar',
            cancelButtonText: "Cancelar"
          }).then((result) => {
            if (result.isConfirmed) {

                borrarProductoFavorito(id);

                ////console.log(id);

              Swal.fire(
                'Eliminado',
                'Se ha eliminado Correctamente',
                'success'
              )
            }});



        });


    });



}


// Funcion para borrar Productos

    function borrarProductoFavorito(id){


        let xhr = new XMLHttpRequest();

        let datos = new FormData();

        datos.append("id",id);

        xhr.open("POST","../controllersFavoritos/borrarFavoritos.php",true);

        xhr.onload = function(){

            if(xhr.status === 200){

                    let respuesta = JSON.parse(xhr.responseText);
                      //console.log(respuesta,"Borro Favorito");
                    llenarFavoritos();


            }

        }

        xhr.send(datos);
    }
