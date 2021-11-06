<section class="terminarPago">


   <h3>¡ Excelente !</h3>

    <h4>Tu pedido fue ingresado con éxito</h4>

    <p> Solo te queda un último paso: </p>

    <h5> Metodo de pago: <span><?php echo $metodo; ?></span></h5>
    <p class="total"> Total: $<?php echo $total; ?></p>

    <div class="pagar">

        <h6> Terminá tu pago ahora mismo</h6>
        <img>

        <?php if($metodo == "abitab"): ?>
            <p>Debes hacer tu pago por: </p>
            <ol>
                <li class="deposito"><span>Deposito en Local Abitab a Prex.</span>
                    <ul>
                        <li>- C.I: 52763432</li>
                        <li>- Nombre: Facundo Jauregui</li>
                    </ul>
                </li>
                <li><span>Transeferencia por la App de Prex a Prex.</span>
                    <ul>
                        <li>- C.I: 52763432</li>
                        <li>- Nombre: Facundo Jauregui</li>
                    </ul>
                </li>

            </ol>

            <br>
            <p class="comprobante">¡Te escribiremos para que nos envies el comprobante!</p>

            <a class="btn-pagar" href="/accesorios/ventas-jaure">Terminar</a>
        <?php endif;?>
        <?php if($metodo == "redpagos"): ?>
            <p>Debes hacer tu pago por: </p>
            <ol>
                <li class="deposito"><span>Deposito en Local Redpagos a Midinero.</span>
                    <ul>
                        <li>- C.I: 52763432</li>
                        <li>- Nombre: Facundo Jauregui</li>
                    </ul>
                </li>
                <li><span>Transeferencia por la App de Midinero a Midinero.</span>
                    <ul>
                        <li>- N° Cuenta: 9603294 </li>
                        <li>- Nombre: Facundo Jauregui</li>
                    </ul>
                </li>

            </ol>
            <br>
            <small>¡Te escribiremos para que nos envies el comprobante!</small>

            <a class="btn-pagar" href="/accesorios/ventas-jaure">Terminar</a>
        <?php endif;?>

        <?php if($metodo == "mercadopagos"): ?>
            <p>Pulsa para pagar : </p>
            <!-- // SDK MercadoPago.js V2 -->
            <script src="https://sdk.mercadopago.com/js/v2"></script>

            <div class="btn-mercado-pago">


           </div>
            <br>

                <script>
                // Agrega credenciales de SDK
                const mp = new MercadoPago('APP_USR-2cb6a9f8-97ac-4081-8ce9-f7f70de5a01b', {
                        locale: 'es-UY'
                });

                // Inicializa el checkout
                mp.checkout({
                    preference: {
                        id: '<?php echo $preference->id; ?>'
                    },
                    render: {
                            container: '.btn-mercado-pago', // Indica el nombre de la clase donde se mostrará el botón de pago
                            label: 'Pagar', // Cambia el texto del botón de pago (opcional)
                    }
                });
                </script>


        <?php endif;?>

        <?php if($metodo == "paypal"): ?>
            <p>Términa ahora mismo tu pago: </p>

            <div class="btn-mercado-pago">


           </div>
        <?php endif;?>

        <small>Por cuestiones de seguridad no enviaremos el pedido hasta que recibir el pago.<small>
    </div>


</section>