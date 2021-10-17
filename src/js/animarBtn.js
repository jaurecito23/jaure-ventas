function animarBoton() {


    let btn = document.querySelectorAll(".animar-btn");

    setInterval(() => {

        btn.forEach((btnAnimar)=>{

            btnAnimar.classList.add("animar-button");

        })

    btn.forEach((btnAnimar)=>{

           setTimeout(() => {

                 btnAnimar.classList.remove("animar-button");

        }, 2000);
        })

    }, 4000 );

}