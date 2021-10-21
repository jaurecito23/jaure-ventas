// Animaciones para el contador de tiempo
function contadorTiempo(){


    let fecha = new Date();
    let dia = fecha.getDate();
    let diaSiguiente = null;

    if(dia === 30 || dia === 31){


        diaSiguiente = 1;

    }else{

        diaSiguiente = dia + 1;

    }


    $(".hot-deal-countdown").countdown(`2021/10/${diaSiguiente} 10:00:00`, function(e){


        $("#dias").html(e.strftime('%D'));
        $("#horas").html(e.strftime('%H'));
        $("#minutos").html(e.strftime('%M'));
        $("#segundos").html(e.strftime('%S'));


    });

}