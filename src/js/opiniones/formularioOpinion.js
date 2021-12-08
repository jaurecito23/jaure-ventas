
let formProducto = document.querySelector(".formulario-puntaje");

document.addEventListener("DOMContentLoaded",()=>{


    if(formProducto){

         eventoEnviarOpinion();
 
        llenarOpiniones();
    }

});


function eventoEnviarOpinion(){

    formProducto.addEventListener("submit",(e)=>{


        e.preventDefault();

        let nombre = document.querySelector(".opinion-nombre").value;
        let email = document.querySelector(".opinion-email").value;
        let opinion = document.querySelector(".opinion-opinion").value;
        let inputsPuntaje = document.querySelectorAll(".opinion-puntaje");

        let puntaje = null;

     inputsPuntaje.forEach((input)=>{

        if(input.checked){
            puntaje = input.value;
        }

    })

   
    

    if(nombre == "" || email == "" || opinion == ""){

        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Debes Completar Todos los Campos',
            showConfirmButton: false,
            timer: 1800
            })
            
    }else  if(!puntaje){
      
        Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: 'Debes Seleccionar un Puntaje (Estrellas)',
        showConfirmButton: false,
        timer: 1000
        })

    }else{

        let xhr = new XMLHttpRequest();

        let datos = new FormData();
        let id_producto = formProducto.getAttribute("data-id");

        datos.append("nombre",nombre);
        datos.append("email",email);
        datos.append("opinion",opinion);
        datos.append("puntaje",puntaje);
        datos.append("id_producto",id_producto);
        
        xhr.open("POST","../controllersOpiniones/nueva_opinion.php",true);

        xhr.onload = function(){

            if(xhr.status === 200){

                let respuesta = JSON.parse(xhr.responseText);

                


                if(respuesta.resultado == "Correcto"){
                    llenarOpiniones();
                   
                 Swal.fire({ 
                position: 'top-end',
                icon: 'success',
                title: '¡Excelente!, su opinion se registro',
                showConfirmButton: false,
                 timer: 1500
                })

            formProducto.reset();


                }else{

                           
                 Swal.fire({ 
                    position: 'top-end',
                    icon: 'error',
                    title: '¡Ups!, hubo un error',
                    showConfirmButton: false,
                     timer: 1500
                    })

                    console.log(respuesta);
                }

            }; 

        }        


        xhr.send(datos);

        }
    })
}

function llenarOpiniones(){

    

    let xhr = new XMLHttpRequest();

    let id_producto = formProducto.getAttribute("data-id");

    let datos = new FormData();

    datos.append("id_producto",id_producto);

    xhr.open("POST","../controllersOpiniones/obtener_opiniones.php",true);

    xhr.onload = function(){

        if(xhr.status === 200){

            let respuesta = JSON.parse(xhr.responseText);
           
            if(respuesta.resultado == "Correcto"){
                promedioPuntaje(respuesta.puntajes);
                ponerOpiniones(respuesta.opiniones);

            }

        }

    }

    xhr.send(datos);

}

function ponerOpiniones(opiniones){

    let opinionesLista = document.querySelector(".opiniones_usuarios");

    opinionesLista.innerHTML = "";

    opiniones.forEach((opinion)=>{

        puntaje = opinion.puntaje;
        vacias = 5 - puntaje;

        estrellas = "";

        for(let i = 0; i < puntaje; i++){
        estrellas += `<i class="fa fa-star"></i>`;
        }

        for(let i = 0; i < vacias; i++){
        estrellas += `<i class="fa fa-star-o empty"></i>`;
        }


        
        

        opinionesLista.innerHTML += `
        <li>
        <div class="review-heading">
            <h5 class="name">${opinion.nombre}</h5>
            <p class="date">${opinion.fecha}</p>
            <div class="review-rating">
                ${estrellas}
            </div>
        </div>
        <div class="review-body">
            <p>${opinion.opinion}</p>
        </div>
    </li>
        
        `


    })

}

function promedioPuntaje(puntajes){
console.log(puntajes);

 let puntaje1 = document.querySelector(".puntaje_1").textContent = puntajes[1];
 let puntaje2 = document.querySelector(".puntaje_2").textContent = puntajes[2];
 let puntaje3 = document.querySelector(".puntaje_3").textContent = puntajes[3];
 let puntaje4 = document.querySelector(".puntaje_4").textContent = puntajes[4];
 let puntaje5 = document.querySelector(".puntaje_5").textContent = puntajes[5];
 
 let totalOpiniones = (puntajes[1] + puntajes[2] + puntajes[3] + puntajes[4] + puntajes[5]);

let widthFragmentos = 100/totalOpiniones; 
widthFragmentos = Math.floor(widthFragmentos);

 let width1 = puntajes[1] * widthFragmentos;
 width1 = width1.toString();
 let barra_1 = document.querySelector(".barra_1").style.width =  width1+"%";
 
 let width2 = puntajes[2] * widthFragmentos;
 width2 = width2.toString();
 let barra_2 = document.querySelector(".barra_2").style.width =  width2+"%";

 let width3 = puntajes[3] * widthFragmentos;
 width3 = width3.toString();
 let barra_3 = document.querySelector(".barra_3").style.width =  width3+"%";
 
 let width4 = puntajes[4] * widthFragmentos;
 width4 = width4.toString();
 let barra_4 = document.querySelector(".barra_4").style.width =  width4+"%";

 let width5 = puntajes[5] * widthFragmentos;
 width5 = width5.toString();
 let barra_5 = document.querySelector(".barra_5").style.width =  width5+"%";
 

 let promedio = null;


    if(totalOpiniones !== 0){

         promedio = (puntajes[1]*1 + puntajes[2] * 2 + puntajes[3] * 3 + puntajes[4] * 4 + puntajes[5] * 5) / totalOpiniones;

    }else{

        promedio = 5;

    }


    
    let redondeado = Math.ceil(promedio);
    let vaciasPromedio = 5 - redondeado;
    document.querySelector(".promedio").textContent = redondeado;
    
    let estrellasPromedio = document.querySelector(".promedio-estrellas");


    estrellasPromedio.innerHTML = "";


    for(let i = 0; i < redondeado; i++){
        estrellasPromedio.innerHTML += `<i class="fa fa-star"></i>`;
    }

    for(let i = 0; i < vaciasPromedio; i++){
        estrellasPromedio.innerHTML += `<i class="fa fa-star-o"></i>`;
    }


    


}
