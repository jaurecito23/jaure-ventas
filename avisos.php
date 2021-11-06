<?php

require 'includes/funciones/app.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;




$fecha = obtenerFecha('actual');

$query = 'SELECT * FROM compras WHERE notificado="0" ;';


$resultado = mysqli_query($db,$query);



foreach ($resultado as $pedido) {

    $idCompra = $pedido['id'];
    $idCarrito = $pedido['idCarrito'];

    $query = "SELECT * FROM productos_carrito WHERE id_carrito = ${idCarrito};";


    $productosCarrito = mysqli_query($db,$query);

    $enviado = enviarEmail($pedido,$productosCarrito);

if($enviado){
     $query = "UPDATE compras SET notificado = '1' WHERE id = '${idCompra}'";

     mysqli_query($db,$query);
}


}

function enviarEmail($pedido,$productosCarrito){

    // Datos del cliente
    $nombres = $pedido['nombres'];
    $apellidos = $pedido['apellidos'];
    $celular = $pedido['celular'];
    $email = $pedido['email'];
    $direccion = $pedido['direccion'];
    $ciudad = $pedido['ciudad'];
    $localidad = $pedido['localidad'];
    $notas = $pedido['notas'];
    $total = $pedido['total'];
    $fecha = $pedido['fecha'];
    $metodo = $pedido['metodo'];
    $pagado = $pedido['pagado'];
    $idCarrito = $pedido['idCarrito'];


    $estado = "Pago No Verificado";

    if($pagado == 1){

        $estado = "Pago Verificado";

    }

    $mail = new PHPMailer();
    $mensaje = new Exception();
    $mail = new PHPMailer();


    // Protocolo para envio de emails
      // Connfigurar SMTP

      //Protocolo
      $mail->isSMTP();


      //Host
      $mail->Host='c2390677.ferozo.com';
      //mail

      $mail->Port=465;
      $mail->SMTPSecure='ssl';
      $mail->SMTPAuth=true;
      $mail->Username='pedidos@jaureventas.com';
      $mail->Password='17FRjb17';

      $mail->setFrom('pedidos@jaureventas.com','JaureVentas');
      $mail->addAddress('pedidos@jaureventas.com','JaureVentas');
      $mail->Subject= 'Tienes un Nuevo Pedido';
      $mail-> isHTML(true);
      $mail->CharSet = 'UTF-8';

    // Para generar el enlace
      $celular[0] = '8';
    $celular= '=59'.$celular;


    $contenido = "<html lang='en'><head> <meta charset='utf-8'/> <title>Pedido</title> <meta name='viewport' content='initial-scale=1.0;maximum-scale=1.0;width=device-width;'> <style>@import url(https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100);body{font-family:'Roboto',helvetica,arial,sans-serif;font-size:4px;font-weight:400;text-rendering:optimizeLegibility;}div.table-title{display:block;margin:auto;max-width:400px;padding:2px;width:100%}.table-title h3{color:#11b009;font-size:20px;font-weight:400;font-style:normal;font-family:Roboto,helvetica,arial,sans-serif;text-shadow:-1px -1px 1px rgba(0,0,0,.1);text-transform:uppercase}.table-fill{background:#fff;border-radius:3px;border-collapse:collapse;height:320px;margin:auto;max-width:600px;overflow:scroll;padding:2px;width:100%;box-shadow:0 5px 10px rgba(0,0,0,.1);animation:float 2s infinite}th{color:#d5dde5;background:#1b1e24;border-bottom:4px solid #9ea7af;border-right:1px solid #343a45;font-size:13px;font-weight:100;padding:5px;text-align:left;text-shadow:0 1px 1px rgba(0,0,0,.1);vertical-align:middle}th:first-child{border-top-left-radius:3px}th:last-child{border-top-right-radius:3px;border-right:none}tr{border-top:1px solid #c1c3d1;border-bottom:1px solid #c1c3d1;color:#666b85;font-size:6px;font-weight:400;text-shadow:0 1px 1px rgba(256,256,256,.1)}tr:hover td{background:#4e5066;color:#fff;border-top:1px solid #22262e}tr:first-child{border-top:none}tr:last-child{border-bottom:none}tr:nth-child(odd) td{background:#ebebeb}tr:nth-child(odd):hover td{background:#4e5066}tr:last-child td:first-child{border-bottom-left-radius:3px}tr:last-child td:last-child{border-bottom-right-radius:3px}td{background:#fff;padding:2px;text-align:left;vertical-align:middle;font-weight:300;font-size:9px;max-height:10px;text-shadow:-1px -1px 1px rgba(0,0,0,.1);border-right:1px solid #c1c3d1}td:last-child{border-right:0}th.text-left{text-align:left;max-height:10px}th.text-center{text-align:center}th.text-right{text-align:right}td.text-left{text-align:left}td.text-center{text-align:center}td.text-right{text-align:right}.lista-datos{width:100%;margin:2rem auto;text-align:left;font-size:1rem}.lista-datos li{margin-bottom:10px}header h1{font-size:20px;text-transform:uppercase;text-align:center;margin-top:2rem}.div-fin{margin:1rem auto;display:flex;flex-direction:column;justify-content:center;align-items:center}.total{background-color:#1b1e24;color:#fff;font-size:1.2rem;border-radius:1rem;padding:1rem;width:40%;text-align:center}.btn{background-color:#11b009;width:40%;font-size:2rem;padding:1rem;border-radius:1rem;color:#fff;font-weight:700;margin:2rem auto}.tabla-body{display:flex;flex-direction:column;jusify-content:center;align-items:center}</style></head><body> <header> <h1>Tienes un nuevo pedido de $nombres</h1> </header> <div class='table-title'> <h3>Usuario Datos de Contacto</h3> </div><ul class='lista-datos' style='display:flex !important; flex-direction:column !important; justify-content: center !important; align-items:center !important;'> <li>Nombres: $nombres</li><br><li>Apellidos: $apellidos</li><br><li>Celular: $celular</li><br><li>Email: $email</li><br><li>Direccion: $direccion</li><br><li>Ciudad: $ciudad</li><br><li>Localidad: $localidad</li><br><li>Notas: $notas</li><br><li>Fecha: $fecha</li><br><li>Metodo: $metodo</li><br><li>Estado: $estado</li><br><li>Total: $total</li><br></ul> <div class='table-title'> <h3>Pedido</h3> </div><table class='table-fill'> <thead> <tr> <th class='text-left'>Id</th> <th class='text-left'>Nombre</th> <th class='text-left'>Precio Anterior</th> <th class='text-left'>Precio</th> </tr></thead> <tbody class='table-hover'>";


    // Iterar sobre los productos
    $cantidades = [];
    $producto = null;



    foreach($productosCarrito as $productoCarrito) {

        $idProducto = $productoCarrito['id_producto'];
        $db = conectarDB();
        $query = "SELECT * FROM productos WHERE id ='$idProducto' LIMIT 1;";

        $producto = mysqli_query($db,$query);
        $producto = mysqli_fetch_assoc($producto);

        $id = $producto['id'];
        $nombre = $producto['nombre'];
        $precio_anterior = $producto['precio_anterior'];
        $precio = $producto['precio'];




        $contenido .="<tr>";
        $contenido .="<td style='font-size: 1.5rem !important; max-height: 25px !important;' class='text-left'>${id}</td>";
        $contenido .="<td style='font-size: 1.5rem !important; max-height: 25px !important;' class='text-left'>${nombre}</td>";
        $contenido .="<td style='font-size: 1.5rem !important; max-height: 25px !important;' class='text-left'>${precio_anterior}</td>";
        $contenido .="<td style='font-size: 1.5rem !important; max-height: 25px !important;' class='text-left'>${precio}</td>";
        $contenido .="</tr>";


    }

    $contenido .= "</tbody></table><div class='div-fin'><p class='total'>Total:${total}</p><br><a class='btn'href='https://api.whatsapp.com/send?phone=${celular}&text=Hola,%20%20%C2%BF%20como%20estas%20?%20Recibimos%20tu%20pedido%20,%20muchas%20gracias%20por%20comprar%20en%20Jaure%20Ventas'>Whatsapp </a></div></body></html>";



        $mail->msgHTML($contenido);

        $enviado = $mail->send();

            echo $mail->ErrorInfo;

            echo $enviado;

        return $enviado;



}






?>