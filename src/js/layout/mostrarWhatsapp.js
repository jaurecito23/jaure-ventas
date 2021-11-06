let whatsapp = document.querySelector(".whatsapp");

document.addEventListener("DOMContentLoaded", ()=>{

if(whatsapp !== null){

   ponerClaseAnimacionWPP();

}


})

function ponerClaseAnimacionWPP() {


    setInterval(() => {

        whatsapp.classList.add("animacion-whatsapp");
        setTimeout(() => {

        whatsapp.classList.remove("animacion-whatsapp");
        }, 3000);

    }, 6000);

}