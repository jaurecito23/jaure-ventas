document.addEventListener("DOMContentLoaded",()=>{


    //eventoPaginaSiguiente();

    if(paginacion){
    ponerCantidadDePaginas();
}

})

let cantidadProductos = 0;
let paginacion = document.querySelector(".store-pagination");
let paginaActual = 1;
function ponerCantidadDePaginas(){


    let xhr = new XMLHttpRequest();

    let datos = new FormData;


    datos.append("id",id_categoria);


         xhr.open("POST","../controllersFiltros/cantidadProductos.php",true);


         xhr.onload = function(){


             if(xhr.status === 200){


                 let respuesta = xhr.responseText;
                 //      let respuesta = xhr.responseText;
                ponerBtnSiguientes(respuesta);
               }

    }


    xhr.send(datos);



}

function ponerBtnSiguientes(cantidadProductos){
    // let cantidadProductos = parseInt(cantidadProductos);
    console.log(cantidadProductos,"cantidad_productos");





    let cantidadPaginas = (((cantidadProductos - cantidadProductos % cantidadProductosMostrar) ) / cantidadProductosMostrar) + 1;



    // console.log(cantidadProductosMostrar, "productos");
    // console.log(cantidadPaginas, "paginas")

    let pagina4ta = paginaActual + 4;
    let diferenciaAlFinal = pagina4ta - cantidadPaginas;

    // console.log(diferenciaAlFinal,"diferenciaFinal");

    // console.log(pagina4ta,"pagina 4ta");

if(pagina4ta > cantidadPaginas){

    switch(diferenciaAlFinal){

            case 1:

            break;

             case 2:
                pagina4ta = pagina4ta -1;
            break;
            case 3:
                pagina4ta = pagina4ta -2;

            break;
                case 4:
                pagina4ta = pagina4ta -3;

            break;


            default:
                paginaActual = cantidadPaginas;
                pagina4ta = cantidadPaginas + 1;

          }

 }

//   console.log(pagina4ta,"pagina 4ta");
paginacion.innerHTML = "";

if(paginaActual !== 1){

    paginacion.innerHTML += `

    <li class="btn-atras-pagina"><a><i class="fa fa-angle-left"></i></a></li>

  `;


}




    for(let i = paginaActual; i < pagina4ta; i++){


        if(i === paginaActual){

            paginacion.innerHTML += `

            <li class="active">${i}</li>

            `;

        }else{

            paginacion.innerHTML += `

            <li class="pagina-siguiente" data-pagina="${i}" >${i}</li>

            `;

        }

  };




  if(paginaActual !== cantidadPaginas){


      paginacion.innerHTML += `

      <li class="btn-siguiente-pagina"><a><i class="fa fa-angle-right"></i></a></li>

      `;
    }
    eventoPaginaSiguiente();

   ponerCartelMostrando(cantidadProductosMostrar,cantidadProductos,paginaActual);




}

function ponerCartelMostrando(mostrando,total,paginaActual){

    let cartel = document.querySelector(".store-qty");

    cartel.innerHTML = `| Mostrando ${mostrando} de ${total} | <br> | Pagina Actual: ${paginaActual} |` ;

}


function eventoPaginaSiguiente(){

   let btnSiguiente = document.querySelector(".btn-siguiente-pagina");

if(btnSiguiente){

    btnSiguiente.addEventListener("click",()=>{

        aumentarPagina();

    })
}
    let btnAtras = document.querySelector(".btn-atras-pagina");
    if(btnAtras){

        btnAtras.addEventListener("click",()=>{

            atrasPagina();

        })
    }
}

function aumentarPagina(){

    let paginaSiguiente = paginaActual + 1;
    cambiarPagina(paginaSiguiente);
    cambiarProductosSiguiente(id_categoria,id_ultimo_producto,id_primer_producto,true);

}
function atrasPagina(){

    let paginaSiguiente = paginaActual - 1;
    cambiarPagina(paginaSiguiente);
    cambiarProductosSiguiente(id_categoria,id_ultimo_producto,id_primer_producto,false);

}



function cambiarPagina(paginaProxima) {

    paginaActual = paginaProxima;
    ponerCantidadDePaginas();

}


function cambiarProductosSiguiente(id_categoria,id_ultimo,id_primero,aumentar){

    let xhr = new XMLHttpRequest();

    let datos = new FormData;

    console.log(id_primero,"Primer Producto");

    datos.append("tipo","cambiarPagina");
    datos.append("id_categoria",id_categoria);
    datos.append("cantidad",cantidadProductosMostrar);
    datos.append("id_ultimo",id_ultimo);
    datos.append("id_primero",id_primero);
    datos.append("aumentar",aumentar);


    xhr.open("POST","../controllersFiltros/filtrarPrecioDescuento.php",true);

    xhr.onload = function(){

        if(xhr.status === 200){

          let respuesta = JSON.parse(xhr.responseText);
            //let respuesta =xhr.responseText;
           // console.log(respuesta);
            let productos = respuesta.productos;
         let imagenes = respuesta.imagenes;
         let id_ultimo = respuesta.id_ultimo;
             id_ultimo_producto = id_ultimo;

         let id_primer = respuesta.id_primero;
             id_primer_producto = id_primer;

             console.log(id_primer_producto,"id_primero");
           console.log(respuesta);
           ////console.log(productos,imagenes);
            ponerProductosTienda(productos,imagenes);

        }

    }

    xhr.send(datos);

}