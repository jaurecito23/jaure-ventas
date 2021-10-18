
let formCrearProducto = document.querySelector(".formulario-crear-producto");

document.addEventListener("DOMContentLoaded",()=>{

        if(formCrearProducto){

            eventoAñadirImagen();
            eventoSiguiente();
        }

})


function eventoAñadirImagen(){

    let btnAñadir = document.querySelector(".btn-añadir-imagen");
    let padreInputs = document.querySelector(".ingresar-imagen")
   

    btnAñadir.addEventListener("click",()=>{

        let div = document.createElement("DIV");

        let imagenActual = parseInt(btnAñadir.getAttribute("data-imagen"));
        
        let imagenSiguiente = imagenActual + 1;

        btnAñadir.setAttribute("data-imagen",imagenSiguiente);

        div.innerHTML = `<label for="imagen-${imagenSiguiente}"><i class="fas fa-images"><p> Img ${imagenSiguiente} </p></i></label>

        <input type="file" acept="image/jpg" id="imagen-${imagenSiguiente}" class="form-control hidden"   name="producto[imagenes][imagen-${imagenSiguiente}]" placeholder="Modelo del Producto"> `;

        padreInputs.insertBefore(div,btnAñadir);

    })

}


function eventoSiguiente(){

    let btnSiguiente = document.querySelectorAll(".btn-siguiente-crear-producto");


    btnSiguiente.forEach((btn)=>{

        
        btn.addEventListener("click",()=>{
            
            let paginaSiguiente = btn.getAttribute("data-siguiente");
            document.querySelector("#parte-1").classList.add("hidden");
            document.querySelector("#parte-2").classList.add("hidden");
            document.querySelector("#parte-3").classList.add("hidden");
            document.querySelector(`#${paginaSiguiente}`).classList.remove("hidden");

        });

    })

}