<main class="resultado_compra">
    <?php if($estado):?>

        <h3>¡ Felicitaciones !</h3>

        <h2> Su compra se ha completado con éxito.</h2>

        <p> Nos pondremos en contacto con usted para la entrega</p>

        <p> ¡Que tenga buen día! </p>

        <h1 class="gracias"> ¡Gracias Por Comprar En JaureVentas!</h1>

        <a class="btn" href="/accesorios/ventas-jaure"> Volver a JaureVentas </a>
        <br><br>
        <small>Si quieres contactarnos por whatsapp. <a href="https://api.whatsapp.com/send?phone=59893693110&text=Hola%20%C2%BFcomo%20est%C3%A1n?,%20acabo%20de%20realizar%20una%20compra.">Click Aquí. <i class="fab fa-whatsapp"></i></a></small>



   <?php endif;?>

   <?php     if(!$estado):?>
    <h3>¡ En espera !</h3>

    <h2> Estamos esperando la confirmación de tu pago.</h2>

    <p> Nos comunicaremos contigo en cuanto lo confirmemos. </p>

    <h1 class="gracias"> ¡Gracias Por Comprar En JaureVentas! </h1>

    <a class="btn" href="/accesorios/ventas-jaure">  Volver a JaureVentas </a>
    <br><br>
        <small>Si quieres contactarnos por whatsapp. <a href="https://api.whatsapp.com/send?phone=59893693110&text=Hola%20%C2%BFcomo%20est%C3%A1n?,%20acabo%20de%20realizar%20una%20compra.">Click Aquí. <i class="fab fa-whatsapp"></i></a></small>

    <?php endif;?>

</main>
