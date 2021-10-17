let resultadosBuscador = document.querySelector(".resultados-buscador");
document.addEventListener("DOMContentLoaded",()=>{


    if(resultadosBuscador){

        eventoBuscador();

    }
})



// Crea el evento de buscador
function eventoBuscador() {


let buscador = document.querySelector(".input-buscar");

console.log(buscador);

buscador.addEventListener("input",buscar);

}


function buscar(e){



        // Genera una expresion para buscar
         let expresion = e.target.value;


         if(expresion !== ""){
            resultadosBuscador.style.display = "block";
            resultadosBuscador.innerHTML = "<div class='resultado'><i style='font-size: 3.5rem; color: white'class='fas fa-circle-notch fa-spin'></i></div>";




             let xhr = new XMLHttpRequest();
             let datos = new FormData();

             datos.append("expresion",expresion);


             xhr.open("POST","../controllersBuscar/buscar.php",true)

             xhr.onload = function (){


                 if(xhr.status === 200){

                     let respuesta = JSON.parse(xhr.responseText);
                     //   let respuesta = xhr.responseText;

                     ponerResultadosBuscador(respuesta);

                    }

                }

                xhr.send(datos);
            }else{

                resultadosBuscador.style.display = "none";

            }



}


function ponerResultadosBuscador(productos) {

    setTimeout(() => {

        resultadosBuscador.innerHTML = "";


        productos.forEach((producto)=>{
            console.log(producto);

            let nombre = producto.nombre;
            nombre = nombre.slice(0,6);

            resultadosBuscador.innerHTML += `

            <div class="resultado" data-id="${producto.id}">
            <img data-id="${producto.id}" src="../imagenes_productos/${producto.imagen}">
            <h4 data-id="${producto.id}">${nombre}...</h4>
            <p data-id="${producto.id}">$${producto.precio}</p>
            <p data-id="${producto.id}"><del>${producto.precio_anterior}</del></p>

        </div>`;

        });

        eventoResultado();
    }, 300);



}

function  eventoResultado() {

    let resultados = document.querySelectorAll(".resultados-buscador .resultado");


    resultados.forEach((resultado)=>{

        resultado.addEventListener("click",(e)=>{

            let id = e.target.getAttribute("data-id");
            window.location.href = "/accesorios/ventas-jaure/producto?id="+id;

        })


    })


}